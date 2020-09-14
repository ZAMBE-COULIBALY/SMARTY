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

        $hsubscriptions= Subscription::all();

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

        $ma=1;
        $ma += Customer::max('id');
        $numdossier =str_pad($codepart.$madate.$ma, 16, "0", STR_PAD_LEFT);

        $Subscription = new \App\Subscription();
        $Subscription->fill(['folder' =>$numdossier]);

        $request->session()->put('Subscription', $Subscription);

       // dd($Subscription);
        return view('pages.customers',compact('Subscription','numdossier'))->with('hsubscription',$hsubscriptions) ;

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
        $categories = Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-TYP")->first()->id);
        $types = Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-KIND")->first()->id);
        $labels = Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-LBL")->first()->id);
        $models = Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-MDL")->first()->id);

        $Subscription = $request->session()->get('Subscription');

        return view('pages.subscriptions',compact("Subscription","categories","types","labels","models"));

    }


    public function postequipment(Request $request)
    {

        $equipmentLibelle = Vocabulary::where("type_id",VocabularyType::where("code","PDT-TYP")->first()->id)->find($request->equipment);
        $equipmentLibelle=$equipmentLibelle['label'];


        $marquelibelle = Vocabulary::where("type_id",VocabularyType::where("code","PDT-LBL")->first()->id)->find($request->mark);
        $marquelibelle=$marquelibelle['label'];

        $modellibelle = Vocabulary::where("type_id",VocabularyType::where("code","PDT-MDL")->first()->id)->find($request->model);
        $modellibelle=$modellibelle['label'];
       // var_dump($modellibelle);exit();
        $codePDV = Agency::Where("id",Agent::where("username","=",Auth()->user()->username)->first()->agency_id)->first()->label;

        //
        $validatedData = $request->validate([
            'code'=> ':subscriptions',
            'equipment'=> 'required:subscriptions',
            'model'=> 'required:subscriptions',
            'mark'=> 'required:subscriptions',
            'numberIMEI'=> 'required|unique:subscriptions',
            'picture'=> 'required:subscriptions',
            'price'=> 'required:subscriptions',
             'date_subscription'=> 'required:subscriptions',
             'customer_id'=> ':subscriptions',

        ]);

        if(empty($request->session()->get('Subscription'))){
            $Subscription = new \App\Subscription();
            $Subscription->fill($validatedData);
            $Subscription->fill([
                'modellibelle' =>$modellibelle,
                'marquelibelle' =>$marquelibelle,
                'equipmentLibelle' =>$equipmentLibelle,
                ]);

            $request->session()->put('Subscription',$Subscription);

        }else{
            $Subscription = $request->session()->get('Subscription');
            $Subscription->fill($validatedData);
            $Subscription->fill([
                'modellibelle' =>$modellibelle,
                'marquelibelle' =>$marquelibelle,
                'equipmentLibelle' =>$equipmentLibelle,
                ]);
            $request->session()->put('Subscription', $Subscription)  ;

        }

    //proforma document creation


        $pdf =  App::make('dompdf.wrapper');

       $pdf-> loadView("models.model_souscription_summary", compact('Subscription','codePDV'));

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

$code =$Subscription['first_name'];
$digits =strtoupper(substr($code,0, 3));

$ma=1;
$ma += Customer::max('id');
$customers_id=$ma;
$digits =$ma.''.$digits;
$codeok =str_pad($digits, 10, "0", STR_PAD_BOTH);
//var_dump($codeok);exit();
        Customer::create([
            'code' =>$codeok,
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
            'code'=>$codeok,
            'equipment' =>$Subscription['equipment'],
            'model' =>$Subscription['model'],
            'mark' =>$Subscription['mark'],
            'picture' =>$Subscription['picture'],
            'numberIMEI' =>$Subscription['numberIMEI'],
            'price' =>$Subscription['price'],
            'date_subscription' =>$Subscription['date_subscription'],
            'customer_id'=>$customers_id,
        ]);



        $pdf =  App::make('dompdf.wrapper');

        $pdf-> loadView("models.document", compact('Subscription'));

        $pdf-> save(storage_path().'/app/public/received/'.$Subscription['first_name'].$Subscription['phone1'].'.pdf');


        return redirect(route('subscription.recu'))->with('success', 'Souscription ('.$codeok. ') effectuée avec succès.');
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

    public function statisticsPDF(Request $request){

        $Subscription = $request->session()->get('Subscription');
        $pdf =  App::make('dompdf.wrapper');

        $pdf-> loadView("models.modelstatistics", compact('Subscription'))->setPaper('a4', 'landscape');

        return $pdf->download('statistics/0926558.pdf');

    }

    public function statisticsExcel(Request $request){

        $Subscription = $request->session()->get('Subscription');
        $xlsx =  App::make('dompdf.wrapper');

        $xlsx-> loadView("models.modelstatistics", compact('Subscription'))->setPaper('a4', 'landscape');

        return $xlsx->download('statistics/0926558.xlsx');

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

    public function etat(Request $request){
        //
        $Subscription = $request->session()->get("Statistics");

        $codePDV = Agency::Where("id",Agent::where("username","=",Auth()->user()->username)->first()->agency_id)->first()->label;

        return view("pages.etat", compact('codePDV'));
    }

public function getstatistics(Request $request){

    $Subscription = $request->session()->get('Subscription');


    $pdf =  App::make('dompdf.wrapper');

    $pdf-> loadView("models.modelstatistics", compact('Subscription'))->setPaper('a4', 'landscape');

    $pdf-> save(storage_path().'/app/public/statistics/statistics.pdf');


    return view("pages.statistics", compact("Subscription"));
}
    /**
     * Display the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $subscription = Subscription::find($id);

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
