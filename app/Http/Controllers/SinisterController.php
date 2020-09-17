<?php

namespace App\Http\Controllers;

use App\Sinister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\database\Query\Builder;
use App\User;
use App\Customer;
use App\Subscription;
use Illuminate\Support\Facades\Input;

class SinisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $Subscription = $request->session()->get('Subscription');

        return view('pages.searchSinister', compact('Subscription'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function statment(Request $request)
    {
        //
        $validatedData = $request->validate([
            'folder'=> ':sinisters',
        ]);

        $Subscription = new \App\Sinister();
        $Subscription->fill( $validatedData);

        $request->session()->put('Subscription', $Subscription);
        $folder=$Subscription['folder'];
        $phone1=$Subscription['folder'];
        $numberIMEI=$Subscription['folder'];
//dd($phone1);
         //$resultat = Subscription::where('code','=',$folder)->get();
         $resultat = DB::table('customers')
         ->join('subscriptions', 'subscriptions.customer_id', '=', 'customers.id')
         ->where('subscriptions.code','=',$folder)->orWhere('subscriptions.numberIMEI','=',$numberIMEI)
         ->orWhere('customers.phone1','=',$phone1)
         ->select('*')
         ->get();
        //dd($resultat);

        $request->session()->put('Subscription', $resultat);
        if(count($resultat) > 0)
            return view('pages.detailSearch',compact('Subscription',"resultat"));
        else

            return view ('pages.detailSearch',compact('Subscription',"resultat"))->withMessage('error','Numéro introuvable. Recherchez un autre dossier !');
     }


    public function create()
    {
        //
       /*  $q = Input::get ( 'q' );
        $user = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();
        if(count($user) > 0)
            return view('welcome')->withDetails($user)->withQuery ( $q );
        else retur n view ('welcome')->withMessage('No Details found. Try to search again !');*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sinister  $sinister
     * @return \Illuminate\Http\Response
     */
    public function show(Sinister $sinister)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sinister  $sinister
     * @return \Illuminate\Http\Response
     */
    public function edit(Sinister $sinister)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sinister  $sinister
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sinister $sinister)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sinister  $sinister
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sinister $sinister)
    {
        //
    }
}
