<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Agent;
use App\Subscription;
use App\Customer;
use App\payments;
use App\Manager;
use App\Partner;
use App\Product;
use App\Role;
use App\User;
use App\Vocabulary;
use App\VocabularyType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Providers\AppServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

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
        $hsubscriptions = DB::table('customers')
        ->join('subscriptions', 'subscriptions.customer_id', '=', 'customers.id')
        ->select('*')
        ->where('subscriptions.agent_id', '=', $agent_id )
        ->get();

        $code = Agency::Where("id",Agent::where("username","=",Auth()->user()->username)->first()->agency_id)->first()->partner_id;
        $codepart=Partner::where("id",$code)->first()->code;
        $date= date_format(date_create(now()),'d-m-Y');
        list($jour,$mois,$annee)=sscanf($date,"%d-%d-%d");
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

        $numdossier =$codepart.$madate.$agent_id.str_pad($subscription+1, 5, "0", STR_PAD_LEFT);

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
             'phone1'=> 'required|unique:customers',
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
        $types = Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-KIND")->first()->id);
        $labels = Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-LBL")->first()->id);
        $models = Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-MDL")->first()->id);


        $Subscription = $request->session()->get('Subscription');

        return view('pages.subscriptions',compact("Subscription","products","categories","types","labels","models"));

    }


    public function postequipment(Request $request)
    {
        $agent_id = Agent::where("username","=",Auth()->user()->username)->first()->id;
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
                'agent_id' =>$agent_id,
                'date_subscription' =>$date_subscription,
                ]);

            $request->session()->put('Subscription',$Subscription);

        }else{
            $Subscription = $request->session()->get('Subscription');
            $Subscription->fill($validatedData);
            $Subscription->fill([
                'libellepdv' =>$libellepdv,
                'agent_id' =>$agent_id,
                'pdv_id' =>$pdv_id,
                'date_subscription' =>$date_subscription,
                ]);

            $request->session()->put('Subscription', $Subscription)  ;

        }

        $madate= $Subscription['date_subscription'];
        $premium = $Subscription['price']*0.10;
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

       $pdf-> save(storage_path().'/app/public/invoices/'.$Subscription['first_name'].'.pdf');


 return redirect(route('subscription.recapitulatif'));

    }

    public function getrecapitulatif(Request $request)
    {
        //
        $Subscription = $request->session()->get('Subscription');

        return view('pages.recapitulatif',compact('Subscription'));


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


        $ma=1;
        $ma += Customer::max('id');
        $customers_id=$ma;

        Customer::create([
            'code' =>$Subscription['folder'],
            'name' =>$Subscription['name'],
           'first_name' =>$Subscription['first_name'],
           'birth_date' =>$Subscription['birth_date'],
           'gender' =>$Subscription['gender'],
           'place_birth' =>$Subscription['place_birth'],
            'marital_status'=>$Subscription['marital_status'],
           'place_residence' =>$Subscription['place_residence'],
           'phone1' =>$Subscription['phone1'],
           'phone2' =>$Subscription['phone2'],
           'mail' =>$Subscription['mail'],
           'folder' =>$Subscription['folder'],
           'mailing_address' =>$Subscription['mailing_address'],

        ]);

        Subscription::create([
            'code'=>$Subscription['folder'],
            'equipment' =>$Subscription['equipment'],
            'model' =>$Subscription['model'],
            'mark' =>$Subscription['mark'],
            'picture' =>$Subscription['picture'],
            'numberIMEI' =>$Subscription['numberIMEI'],
            'price' =>$Subscription['price'],
            'premium' =>$Subscription['premium'],
            'date_subscription' =>$Subscription['date_subscription'],
            'subscription_enddate' =>$Subscription['subscription_enddate'],
            'customer_id'=>$customers_id,
            'agent_id' =>$Subscription['agent_id'],
        ]);



        $pdf =  App::make('dompdf.wrapper');

        $pdf-> loadView("models.document", compact('Subscription'));

        $pdf-> save(storage_path().'/app/public/received/'.$Subscription['first_name'].$Subscription['phone1'].'.pdf');


        return redirect(route('subscription.recu'))->with('success', 'Souscription ('.$Subscription['folder']. ') effectuée avec succès.');
    }


    public function getrecu(Request $request )
    {
        //
        $Subscription = $request->session()->get('Subscription');
        return view('pages.recu',compact('Subscription'));
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
