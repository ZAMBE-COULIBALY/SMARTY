<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Agent;
use App\Subscription;
use App\Customer;
use App\Mail\newProforma;
use App\Mail\newSubscription;
use App\payments;
use App\Manager;
use App\Pack;
use App\Partner;
use App\Payment;
use App\Product;
use App\Role;
use App\User;
use App\Vocabulary;
use App\VocabularyType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Providers\AppServiceProvider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\database\Query\Builder;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Matrix\Operators\Subtraction;

use function GuzzleHttp\Promise\all;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function getcustomers(Request $request)
    {
        //

        $agent_id = Agent::where("username","=",Auth()->user()->username)->first()->id;
        $hsubscriptions = Subscription::all()->where('agent_id', $agent_id );

        $code = Agency::Where("id",Agent::where("username","=",Auth()->user()->username)->first()->agency_id)->first()->partner_id;
        $codepart=Partner::where("id",$code)->first()->code;
        $date= date_format(date_create(now()),'d-m-Y H:i:s');
        list($jour,$mois,$annee,$heure,$munite,$seconde)=sscanf($date,"%d-%d-%d %d:%d:%d");

        if (strlen($mois)===1 ) {
            $mois ='0'.$mois;
        }else {
            $mois =$mois;
        }
        if (strlen($jour)===1){
            $jour ='0'.$jour;
        }else {
            $jour =$jour;
        }

        $madate=$jour.$mois.$annee;
        $datv=$annee.'-'.$mois.'-'.$jour;
        $annee=$annee-18;
        $dat=$annee.'-'.$mois.'-'.$jour;
        //dd($datv);


        $partner = Agent::where("username","=",Auth()->user()->username)->first()->agency->partner;
        $subscription = Subscription::all()->whereIn('agent_id',Agent::all()->whereIn('agency_id',Agency::all()->where('partner_id', '=',$partner->id)->pluck('id'))->pluck('id'))->where('date_subscription','=',$datv)->count();
       //dd($subscription);

        $numdossier =$codepart.$madate.$agent_id.$munite.$seconde.str_pad($subscription+1, 5, "0", STR_PAD_LEFT);

        $Subscription = new \App\Subscription();
        $Subscription->fill(['folder' =>$numdossier,
        'dat'=>$dat,]);

        $request->session()->put('Subscription', $Subscription);

       // dd($Subscription);
        return view('pages.customers',compact('Subscription','numdossier','dat'))->with('hsubscription',$hsubscriptions) ;

    }

    public function postcustomers(Request $request)
    {
        //
        $validatedData = $request->validate([
            'code' => ':customers',
             'name' => 'required:customers',
             'first_name'=> 'required:customers',
             'birth_date'=> 'required:customers',
             'gender'=> 'required:customers',
             'place_birth'=> 'required:customers',
             'marital_status'=> 'required:customers',
             'place_birth'=> 'required:customers',
             'place_residence'=> 'required:customers',
             'phone1'=> 'required:customers',
             'phone2'=> ':customers',
             'mail'=> ':customers',
             'folder'=> ':customers',
             'mailing_address'=> ':customers',

        ]);
        //var_dump($validatedData);exit();
        if(empty($request->session()->get('Subscription'))){
            $Subscription = new \App\Subscription();
            $Subscription->fill($validatedData);

            $request->session()->put('Subscription', $Subscription);
        }else{
            $Subscription = $request->session()->get('Subscription');
            $Subscription->fill($validatedData);

            $request->session()->put('Subscription', $Subscription);
        }
        //dd($Subscription);
            return redirect(route('subscription.getequipment'));
    }


    public function index(Request $request)
    {
        //
        $Subscription = $request->session()->get('Subscription');

        return view('pages.subscriptions',compact('Subscription'));

    }

    public function getequipment(Request $request)
    {
        //
        $usr = User::find(Auth::user()->id);
        $code = Agency::Where("id",Agent::where("username","=",Auth()->user()->username)->first()->agency_id)->first()->partner_id;
        if ($usr->hasRole("manager")) {
            $products = Product::all()->where("partner_id",$usr->manager->partner_id);
        }
        elseif ($usr->hasRole("agent_chief") OR $usr->hasRole("agent")){
            $products = Product::all()->where("partner_id",'=',$code);

        }
        else {
            $products = Product::all()->whereIn("partner_id",Partner::where("admin_id",$usr->id));
        }
        $categories = Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-TYP")->first()->id);
        $types = Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-KIND")->first()->id)->whereIn('id',$products->pluck("type_id"));
        $labels = Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-LBL")->first()->id);
        $models = Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-MDL")->first()->id);


        $Subscription = $request->session()->get('Subscription');

        return view('pages.subscriptions',compact("Subscription","products","categories","types","labels","models","usr"));

    }


    public function postequipment(Request $request)
    {
        $agent= Agent::where("username","=",Auth()->user()->username)->first();
        $libellepdv = Agency::Where("id",Agent::where("username","=",Auth()->user()->username)->first()->agency_id)->first()->label;
        $pdv_id = Agency::Where("label",$libellepdv)->first()->id;
        $date_subscription= date_format(date_create(now()),'Y-m-d');
        //dd($codepdv);
        $validatedData = $request->validate([
                'code'=> ':subscriptions',
                'equipment'=> 'required:subscriptions',
                'model'=> 'required:subscriptions',
                'mark'=> 'required:subscriptions',
                'numberIMEI'=> 'required|unique:subscriptions',
                'picture'=> ':subscriptions',
                'price'=> 'required:subscriptions',
                'premium'=> ':subscriptions',
                'date_subscription'=> ':subscriptions',
                'subscription_enddate'=> ':subscriptions',
                'agent_id'=> ':subscriptions',
                'customer_id'=> ':subscriptions',

        ]);

        if(empty($request->session()->get('Subscription'))){
            $Subscription = new \App\Subscription();
            $Subscription->fill($validatedData);
            $Subscription->fill([
                'libellepdv' =>$libellepdv,
                'pdv_id' =>$pdv_id,
                'agent_id' =>$agent->id,
                'date_subscription' =>$date_subscription,
                ]);

            $request->session()->put('Subscription',$Subscription);

        }else{
            $Subscription = $request->session()->get('Subscription');
            $Subscription->fill($validatedData);
            $Subscription->fill([
                'libellepdv' =>$libellepdv,
                'agent_id' => $agent->id,
                'pdv_id' =>$pdv_id,
                'date_subscription' =>$date_subscription,
                ]);

            $request->session()->put('Subscription', $Subscription)  ;

        }

        $madate= $Subscription['date_subscription'];
        $premium = $Subscription['price'] * $agent->agency->partner->rate / 100 ;
        list($annee,$mois,$jour)=sscanf($madate,"%d-%d-%d");
        $annee+=1;

        if (strlen($mois)===1) {
            $mois ='0'.$mois;
        }else {
            $mois =$mois;
        }
        if (strlen($jour)===1){
            $jour ='0'.$jour;
        }else {
            $jour =$jour;
        }
        $subscription_enddate=$annee.'-'.$mois.'-'.$jour;

        //proforma document creation
        $usr = User::find(Auth::user()->id);
        $code = Agency::Where("id",Agent::where("username","=",Auth()->user()->username)->first()->agency_id)->first()->partner_id;
        if ($usr->hasRole("manager")) {
            $products = Product::all()->where("partner_id",$usr->manager->partner_id);
        }
        elseif ($usr->hasRole("agent_chief") OR $usr->hasRole("agent")){
            $products = Product::all()->where("partner_id",'=',$code);

        }
        else {
            $products = Product::all()->whereIn("partner_id",Partner::where("admin_id",$usr->id));
        }
        foreach ($products as $item){
            if ($item->type->id==$Subscription['equipment']){
                $equipmentLibelle=$item->type->label;
            }
            if ($item->label->id==$Subscription['mark']){
                $marquelibelle=$item->label->label;
            }
            if ($item->model->id==$Subscription['model']){
                $modellibelle=$item->model->label;
            }
        }
        //dd($equipmentLibelle);
        $Subscription->fill([
            'subscription_enddate' =>$subscription_enddate,
            'premium' =>$premium,
            'equipmentLibelle' =>$equipmentLibelle,
            'marquelibelle' =>$marquelibelle,
            'modellibelle' =>$modellibelle,
            ]);

        $request->session()->put('Subscription', $Subscription)  ;
        //dd($Subscription);

        $pdf =  App::make('dompdf.wrapper');

       $pdf-> loadView("models.model_souscription_summary", compact('Subscription'));

       $pdf-> save(storage_path().'/app/public/invoices/'.$Subscription['first_name'].$Subscription['phone1'].'.pdf');


        return redirect(route('subscription.recapitulatif'));

    }

    public function getrecapitulatif(Request $request)
    {
        //
        $Subscription = $request->session()->get('Subscription');
        $connectedagent = User::where('username',Auth::user()->username)->first();
         //proforma document
         $date = date("Y-m-d H:i:s");

         if (Agent::where('username',$connectedagent->username)->first()->agency->partner->paymode == 1) {
             # code...
             $params = [];
             try {
                 //code...
             $custom = json_encode($Subscription);
             $designation = "Paiement de la souscription N°".$Subscription['folder'];
             $params = [
                 "cpm_amount" =>$Subscription['premium'],
                 "cpm_designation" => $designation ,
                 "cpm_trans_id" => $Subscription['folder'],
                 "cpm_trans_date" => $date,
                 "cpm_language" => "fr",
                 "cpm_version" => "V1",
                 "cpm_page_action" => "PAYMENT",
                 "cpm_payment_config" =>"SINGLE" ,
                 "cpm_currency" => "CFA",
                 "cpm_site_id" => "448173",
                 "apikey" => "13013879545bdc3a5579f458.42836232",
                 "cpm_custom" => json_encode($Subscription),
             ];
             $client = new Client();
                     $response = $client->request("POST","https://api.cinetpay.com/v1/?method=getSignatureByPost",
                     [
                         'verify' => false,
                         'headers' => [
                             'Content-Type'     => 'application/x-www-form-urlencoded',
                         ],
                         'form_params' => $params
                     ]);

                     $reponse = \GuzzleHttp\json_decode($response->getBody());
                     $signature = $reponse;
                     $params["notify_url"] = route("paiementmobile");
                     $params["return_url"] = route("documentmobilepayment");
                     $params["cancel_url"] = route("subscription.recapitulatif");
                     $params["debug"] = 0;
                     $params["signature"] = $signature;
                     unset( $params["cpm_trans_date"]);
             //dd($params);
             foreach ($params as $key => $value){
             $_POST[$key] = $value;
             }

             } catch (\Throwable $th) {
                 //throw $th;
             }
         }
         try {
            //code...
            Mail::to($Subscription["mail"], "Souscripteur ".$Subscription['first_name']." ".$Subscription['name'])
            ->send(new newProforma($Subscription));
        Log::info('Proforma send mail ok '.now());

        } catch (\Throwable $th) {
            throw $th;
            Log::warning('Erreur de mail : '.json_encode($Subscription));

        }

        return view('pages.recapitulatif',compact('Subscription','date','connectedagent'));


    }




    public function create(Request $request)
    {
        //
        $parameters = $request->session()->get('Subscription');

        return view('pages.subscriptions',compact('Subscription'));


    }

    public function storecustomers(Request $request)
    {

        $Subscription = $request->session()->get('Subscription');
        $customer = new Customer();
        $newsubscription = new Subscription();
        $pack = new Pack();

        $payment = new Payment();

        try {
            //code...


            Log::info('Création customer start '.now());

            $customer->code =  $Subscription['folder'];
            $customer->name = $Subscription['name'];
            $customer->first_name = $Subscription['first_name'];
            $customer->birth_date = $Subscription['birth_date'];
            $customer->gender = $Subscription['gender'];
            $customer->place_birth = $Subscription['place_birth'];
            $customer->marital_status = $Subscription['marital_status'];
            $customer->place_residence = $Subscription['place_residence'];
            $customer->phone1 = $Subscription['phone1'];
            $customer->phone2 = $Subscription['phone2'];
            $customer->mail = $Subscription['mail'];
            $customer->folder = $Subscription['folder'];
            $customer->mailing_address = $Subscription['mailing_address'];
            $customer->save();

            Log::info('Création customer ok '.now());
            Log::info('Création subscription start '.now());

            $newsubscription->code = $Subscription['folder'];
            $newsubscription->equipment = $Subscription['equipment'];
            $newsubscription->model = $Subscription['model'];
            $newsubscription->mark = $Subscription['mark'];
            $newsubscription->picture = $Subscription['picture'];
            $newsubscription->numberIMEI = $Subscription['numberIMEI'];
            $newsubscription->price = $Subscription['price'];
            $newsubscription->premium = $Subscription['premium'];
            $newsubscription->date_subscription = $Subscription['date_subscription'];
            $newsubscription->subscription_enddate = $Subscription['subscription_enddate'];
            $newsubscription->customer_id = $customer->id;
            $newsubscription->agent_id = $Subscription['agent_id'];
            $newsubscription->state = 1;
            $newsubscription->save();
            Log::info('Création subscipriotn ok '.now());

            Log::info('Création pack start '.now());

            $pack->product_id = 1;
            try {
                //code...
                $pack->product_id = Product::where("type_id",$Subscription['equipment'])->where("label_id",$Subscription['mark'])->where("model_id",$Subscription['model'])->first()->id;

            } catch (\Throwable $th) {
                //throw $th;
            }
            $pack->subscription_id = $newsubscription->id;
            $pack->save();
            Log::info('Création pack ok '.now());

            Log::info('Update equipment subscr start '.now());

            $newsubscription->equipment = $pack->id;
            $newsubscription->save();
            Log::info('Update equipment ok '.now());

            Log::info('Création payment start '.now());

            $payment->refsubscription = $newsubscription->code;
            $payment->paymentmethod = 1;
            $payment->refpayment = $newsubscription->code;
            $payment->datepayment = $newsubscription->date_subscription;
            $payment->amount = $newsubscription->premium;

            $payment->save();
            Log::info('Création payment ok '.now());

            Log::info('Création pdf document start '.now());

            $pdf =  App::make('dompdf.wrapper');

            $pdf-> loadView("models.document", compact('newsubscription'));

            $pdf-> save(storage_path().'/app/public/received/'.$customer->first_name.$customer->phone1.'.pdf');
            Log::info('Création pdf document ok '.now());

            Log::info('Création send mail start '.now());
            try {
                //code...
                Mail::to($customer->mail, "Souscripteur .$customer->first_name. .$customer->first_name")
                ->send(new newSubscription($newsubscription));
            Log::info('Création send mail ok '.now());

            } catch (\Throwable $th) {
                // throw $th;
                Log::warning('Erreur de mail : '.json_encode($Subscription));

            }


            return redirect(route('subscription.recu'))->with('success', 'Souscription ('.$newsubscription->code. ') effectuée avec succès.');

        } catch (\Throwable $th) {
            // throw $th;
            Log::warning('Erreur de souscription : '.json_encode($Subscription));
            Log::warning('Erreur : '.json_encode($th));
            return redirect(route('subscription.customer'))->with('error','Erreur de souscription ');
        }
        return redirect(route('subscription.customer'))->with('error','Erreur de souscription ');

    }

    public function paiementmobile (Request $request)
    {


        // if(empty($request->session()->get('subscription')))
        // return redirect(route('subscriptions.list'))->with('warning','Aucune souscription en cours de traitement');
        Log::info(json_encode($request->all()));
        Log::info(json_encode($request["cpm_trans_id"]));
        if (null !== $request['cpm_trans_id']) {

            Log::info('le numero de transacion est bien recu'.now());
            $id_transaction = $_POST['cpm_trans_id'];
            if(null !== Payment::where("refpayment","=",$id_transaction)->first())
            {
                Log::info("Operation $id_transaction déjà effectuée");
                return 0;
            }

            //Veuillez entrer votre apiKey et site ID
            $apiKey = "13013879545bdc3a5579f458.42836232";
            $site_id = "448173";
            $plateform = "PROD";
            $version = "V1";
            $params = [
                "apikey" => "13013879545bdc3a5579f458.42836232",
                "cpm_site_id" => "448173",
                "cpm_trans_id" => $id_transaction,

            ];
            $client = new Client();
            $response = $client->request("POST","https://api.cinetpay.com/v1/?method=checkPayStatus",
            [
                'verify' => false,
                'headers' => [
                    'Content-Type'     => 'application/x-www-form-urlencoded',
                ],
                'form_params' => $params
            ]);

            $reponse = json_decode($response->getBody());
            $transaction = $reponse->transaction;
            Log::alert('recuperation informations transacton ok '.json_encode($transaction). ' h '.now());



            $cpm_site_id = $transaction->cpm_site_id;
            $signature = $transaction->signature;
            $cpm_amount = $transaction->cpm_amount;
            $cpm_trans_id = $transaction->cpm_trans_id;
            $cpm_custom = $transaction->cpm_custom;
            $cpm_currency = $transaction->cpm_currency;
            $cpm_payid = $transaction->cpm_payid;
            $cpm_payment_date = $transaction->cpm_payment_date;
            $cpm_payment_time = $transaction->cpm_payment_time;
            $cpm_error_message = $transaction->cpm_error_message;
            $payment_method = $transaction->payment_method;
            $cpm_phone_prefixe = $transaction->cpm_phone_prefixe;
            $cel_phone_num = $transaction->cel_phone_num;
            $cpm_ipn_ack = $transaction->cpm_ipn_ack;
            $created_at = $transaction->created_at;
            $updated_at = $transaction->updated_at;
            $cpm_result = $transaction->cpm_result;
            $cpm_trans_status = $transaction->cpm_trans_status;
            $cpm_designation = $transaction->cpm_designation;
            $buyer_name = $transaction->buyer_name;

            if($cpm_result == '00'){
              $Subscription = json_decode($cpm_custom);


            }

            $customer = new Customer();
            $newsubscription = new Subscription();


            $pack = new Pack();


                       $payment = new Payment();


            try {
                //code...
                    $customer->code = $Subscription->folder;
                $customer->name = $Subscription->name;
                $customer->first_name = $Subscription->first_name;
                $customer->birth_date = $Subscription->birth_date;
                $customer->gender = $Subscription->gender;
                $customer->place_birth = $Subscription->place_birth;
                $customer->marital_status = $Subscription->marital_status;
                $customer->place_residence = $Subscription->place_residence;
                $customer->phone1 = $Subscription->phone1;
                $customer->phone2 = $Subscription->phone2;
                $customer->mail = $Subscription->mail;
                $customer->folder = $Subscription->folder;
                $customer->mailing_address = $Subscription->mailing_address;
                $customer->save();
                $newsubscription->code = $Subscription->folder;
                $newsubscription->equipment = $Subscription->equipment;
                $newsubscription->model = $Subscription->model;
                $newsubscription->mark = $Subscription->mark;
                $newsubscription->picture = $Subscription->picture;
                $newsubscription->numberIMEI = $Subscription->numberIMEI;
                $newsubscription->price = $Subscription->price;
                $newsubscription->premium = $Subscription->premium;
                $newsubscription->date_subscription = $Subscription->date_subscription;
                $newsubscription->subscription_enddate = $Subscription->subscription_enddate;
                $newsubscription->customer_id = $customer->id;
                $newsubscription->agent_id = $Subscription->agent_id;
                $newsubscription->state = 1;
                $newsubscription->save();

                $pack->product_id = Product::where("type_id",$Subscription->equipment)->where("label_id",$Subscription->mark)->where("model_id",$Subscription->model)->first()->id;
                ;
                $pack->subscription_id = $newsubscription->id;
                $pack->save();
                $newsubscription->equipment = $pack->id;
                $newsubscription->save();

                $payment->refsubscription = $newsubscription->code;
                $payment->paymentmethod = 2;
                $payment->refpayment = $cpm_trans_id;
                $payment->datepayment = $cpm_payment_date;
                $payment->amount = $newsubscription->premium;
                $payment->save();
                $pdf =  App::make('dompdf.wrapper');

                $pdf-> loadView("models.document", compact('newsubscription'));

                $pdf-> save(storage_path().'/app/public/received/'.$newsubscription->customer->first_name.$newsubscription->customer->phone1.'.pdf');

                
            } catch (\Throwable $th) {
                Log::alert(json_encode($th));
                Log::alert('Paiement echoué');
                return 0;


            }
                try {
                    //code...
                    Mail::to($customer->mail, "Souscripteur .$customer->first_name. .$customer->first_name")
                    ->send(new newSubscription($newsubscription));
                Log::info('Création send mail ok '.now());
    
                } catch (\Throwable $th) {
                    Log::warning('Erreur de mail : '.json_encode($Subscription));
    
                }





            }
            else{
                    //Le paiement a échoué
                    Log::alert('Paiement echoué');
                    return 0;

                }

        return 0;

    }



    public function getrecu(Request $request)
    {
        //
        $Subscription = $request->session()->get('Subscription');
        $subscription = Subscription::where('code',$Subscription['folder'])->first();
        $newsubscription = clone $subscription;
        // Log::info('Création pdf document start '.now());

        // $pdf =  App::make('dompdf.wrapper');

        // $pdf-> loadView("models.document", compact('newsubscription'));

        // $pdf-> save(storage_path().'/app/public/received/'.$newsubscription->customer->first_name.$newsubscription->customer->phone1.'.pdf');
        // Log::info('Création pdf document ok '.now());

        return view('pages.recu',compact('subscription'));
    }

    public function documentmobilepayment(Request $request)
    {


        # code...
        if (isset($_POST['cpm_trans_id'])) {
            // SDK PHP de CinetPay

            try {
                // Initialisation de CinetPay et Identification du paiement
                $id_transaction = $_POST['cpm_trans_id'];
                //Veuillez entrer votre apiKey et site ID
                //Veuillez entrer votre apiKey et site ID
            $apiKey = "13013879545bdc3a5579f458.42836232";
            $site_id = "448173";
            $plateform = "PROD";
            $version = "V1";
            $params = [
                "apikey" => "13013879545bdc3a5579f458.42836232",
                "cpm_site_id" => "448173",
                "cpm_trans_id" => $id_transaction,

            ];
            $client = new Client();
            $response = $client->request("POST","https://api.cinetpay.com/v1/?method=checkPayStatus",
            [
                'verify' => false,
                'headers' => [
                    'Content-Type'     => 'application/x-www-form-urlencoded',
                ],
                'form_params' => $params
            ]);

            $reponse = json_decode($response->getBody());
            $transaction = $reponse->transaction;
            Log::alert('recuperation informations transacton ok '.json_encode($transaction). ' h '.now());



            $cpm_site_id = $transaction->cpm_site_id;
            $signature = $transaction->signature;
            $cpm_amount = $transaction->cpm_amount;
            $cpm_trans_id = $transaction->cpm_trans_id;
            $cpm_custom = $transaction->cpm_custom;
            $cpm_currency = $transaction->cpm_currency;
            $cpm_payid = $transaction->cpm_payid;
            $cpm_payment_date = $transaction->cpm_payment_date;
            $cpm_payment_time = $transaction->cpm_payment_time;
            $cpm_error_message = $transaction->cpm_error_message;
            $payment_method = $transaction->payment_method;
            $cpm_phone_prefixe = $transaction->cpm_phone_prefixe;
            $cel_phone_num = $transaction->cel_phone_num;
            $cpm_ipn_ack = $transaction->cpm_ipn_ack;
            $created_at = $transaction->created_at;
            $updated_at = $transaction->updated_at;
            $cpm_result = $transaction->cpm_result;
            $cpm_trans_status = $transaction->cpm_trans_status;
            $cpm_designation = $transaction->cpm_designation;
            $buyer_name = $transaction->buyer_name;

            if($cpm_result == '00'){

                // une page HTML de paiement bon
                $subscription = Subscription::where("code","=",$cpm_trans_id)->first();
                //dd($cpm_trans_id);
                Log::alert('Le paiement de la souscription a réussi');
                $user =  User::find($subscription->agent->user->id);
                Auth::login($user);
                Session::Put("success",'Souscription ('.$subscription->code. ') effectuée avec succès.');


                      return view('pages.recu',compact('subscription'));

                }else{
                    // une page HTML de paiement echoué
                    Log::alert('Le paiement de la souscription a échoué');

                 return redirect(route('subscription.customer'))->with('error','Le paiement de la souscription a échoué');

                }
            } catch (Exception $e) {
                // Une erreur s'est produite
                Log::alert("Erreur :" . $e->getMessage().now());
                throw $e;
            }
        } else {
           // redirection vers la page d'accueil
           Log::alert('Le paiement de la souscription a échoué');

           return redirect(route('subscription.customer'))->with('warning','Aucune souscription en cours de traitement');

        }



        return redirect(route('subscription.customer'))->with('warning','Aucune souscription en cours de traitement');


    }

    public function exportToPDF(Request $request){

        $equipmentLibelle = Vocabulary::where("type_id",VocabularyType::where("code","PDT-TYP")->first()->id)->find($request->equipment);
        $equipmentLibelle=$equipmentLibelle['label'];

        $marquelibelle = Vocabulary::where("type_id",VocabularyType::where("code","PDT-LBL")->first()->id)->find($request->mark);
        $marquelibelle=$marquelibelle['label'];
        $pdf =  App::make('dompdf.wrapper');
        $Subscription = $request->session()->get('Subscription');

        $pdf-> loadView("models.document", compact('Subscription','equipmentLibelle','marquelibelle'));

        return $pdf->download($Subscription['first_name'].$Subscription['phone1'].'.pdf');

    }

    public function proforma(Request $request){


        $equipmentLibelle = Vocabulary::where("type_id",VocabularyType::where("code","PDT-TYP")->first()->id)->find($request->equipment);
        $equipmentLibelle=$equipmentLibelle['label'];

        $marquelibelle = Vocabulary::where("type_id",VocabularyType::where("code","PDT-LBL")->first()->id)->find($request->mark);
        $marquelibelle=$marquelibelle['label'];
        $Subscription = $request->session()->get('Subscription');

        $pdf =  App::make('dompdf.wrapper');

        $pdf-> loadView("models.model_souscription_summary", compact('Subscription','equipmentLibelle','marquelibelle'));

        return $pdf->download('proforma/'.$Subscription['first_name'].$Subscription['phone1'].'.pdf');

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function precedent()
    {

        return redirect()->back();

    }

    public function store(Request $request)
    {
        $parameters = $request->session()->get('subscription');

        $parameters->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //


        //return
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
