<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\Customer;
use App\payments;
use App\Providers\AppServiceProvider;
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

        return view('pages.Customers',compact('Subscription'));

    }

    public function postcustomers(Request $request)
    {
        //
        $validatedData = $request->validate([
             'name' => 'required|unique:customers',
             'first_name'=> 'required|unique:customers',
             'birth_date'=> 'required|unique:customers',
             'gender'=> 'required|unique:customers',
             'place_birth'=> 'required|unique:customers',
             'marital_status'=> 'required|unique:customers',
             'place_birth'=> 'required|unique:customers',
             'place_residence'=> 'required|unique:customers',
             'phone1'=> 'required|unique:customers',
             'phone2'=> 'required|unique:customers',
             'mail'=> 'required|unique:customers',

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

        return view('pages.Subscriptions',compact('Subscription'));

    }

    public function getequipment(Request $request)
    {
        //
        $Subscription = $request->session()->get('Subscription');

        return view('pages.Subscriptions',compact('Subscription'));

    }


    public function postequipment(Request $request)
    {
        //
        $validatedData = $request->validate([
            'equipment'=> 'required|unique:subscriptions',
            'model'=> 'required|unique:subscriptions',
            'mark'=> 'required|unique:subscriptions',
            'numberIMEI'=> 'required|unique:subscriptions',
            'picture'=> 'required|unique:subscriptions',
            'price'=> 'required|unique:subscriptions',
             'date_subscription'=> 'required|unique:subscriptions',

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

        $pdf =  App::make('dompdf.wrapper');

        $pdf-> loadView("models.document", compact('Subscription'));

        $pdf-> save(storage_path().'/app/public/invoices/'.$Subscription['phone1'].'.pdf');


        return redirect(route('subscription.recu'))->with('Souscription effectuée !!');
    }


    public function getrecu()
    {
        //
        return view('pages.recu');
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


    public function postcreate(Request $request)
    {
        //
        $validatedData = $request->validate([
            'numberIMEI' => 'required|unique:subscriptions',
        ]);
        if(empty($request->session()->get('subscription'))){
            $parameters = new \App\Subscription();
            $parameters->fill($validatedData);
            $request->session()->put('subscription', $parameters);
        }else{
            $parameters = $request->session()->get('subscription');
            $parameters->fill($validatedData);
            $request->session()->put('subscription', $parameters);
        }
        return redirect()->route('subscription.add');

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
