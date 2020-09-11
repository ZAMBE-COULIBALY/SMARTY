<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\Customer;
use App\payments;
use App\Providers\AppServiceProvider;
use App\transsubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
       $Subscription = $request->session()->get('Subscription');
        $hsubscriptions= Subscription::all();

        return view('pages.customers',compact('Subscription'))->with('hsubscription',$hsubscriptions) ;

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
             'phone2'=> 'required:customers',
             'mail'=> 'required:customers',

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
        $Subscription = $request->session()->get('Subscription');

        return view('pages.subscriptions',compact('Subscription'));

    }


    public function postequipment(Request $request)
    {
        //
        $validatedData = $request->validate([
            'code'=> ':subscriptions',
            'equipment'=> 'required:subscriptions',
            'model'=> 'required:subscriptions',
            'mark'=> 'required:subscriptions',
            'numberIMEI'=> 'required:subscriptions',
            'picture'=> 'required:subscriptions',
            'price'=> 'required:subscriptions',
             'date_subscription'=> 'required:subscriptions',
             'customer_id'=> ':subscriptions',

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

    //proforma document creation
       // dd($Subscription);

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
//var_dump($Subscription);exit();
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
        $Subscription = $request->session()->get('Subscription');
        $pdf =  App::make('dompdf.wrapper');

        $pdf-> loadView("models.document", compact('Subscription'));

        return $pdf->download($Subscription['first_name'].$Subscription['phone1'].'.pdf');

    }

    public function proforma(Request $request){
        $Subscription = $request->session()->get('Subscription');
        $pdf =  App::make('dompdf.wrapper');

        $pdf-> loadView("models.model_souscription_summary", compact('Subscription'));

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
