<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use League\CommonMark\Inline\Element\Code;
use Illuminate\Support\Facades\DB;
use App\Agency;
use App\Agent;
use App\Subscription;
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
use Illuminate\Support\Facades\App;
use Illuminate\database\Query\Builder;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customer = Customer::all();
        //var_dump($customer);exit();
        return view('pages.listecustomers')->with('customer',$customer) ;




    }


    public function etat(Request $request){
        //
        $libellepdv = Agency::Where("id",Agent::where("username","=",Auth()->user()->username)->first()->agency_id)->first()->label;
        $codepdv = Agency::Where("label",$libellepdv)->first()->code;
        $agent_id =Agent::where("username","=",Auth()->user()->username)->first()->id;
        $pdv_id = Agency::Where("label",$libellepdv)->first()->id;

        $Subscription = new \App\Customer();
        $Subscription->fill([
            'libellepdv' =>$libellepdv,
            'codepdv' =>$codepdv,
            'pdv_id' =>$pdv_id,
            'agent_id' =>$agent_id,
            'date_deb' =>'date_deb',
            'date_fin' =>'date_fin',
            ]);
//dd($Subscription);
            $request->session()->put('Subscription', $Subscription);

        return view("pages.etat", compact('Subscription'));
    }
//
public function getstatistics(Request $request){
    $Subscription = $request->session()->get('Subscription');
    $libellepdv = Agency::Where("id",Agent::where("username","=",Auth()->user()->username)->first()->agency_id)->first()->label;
    $pdv_id = Agency::Where("label",$libellepdv)->first()->id;
    $agent_id =Agent::where("username","=",Auth()->user()->username)->first()->id;


    $users = DB::table('customers')
            ->join('subscriptions', 'subscriptions.customer_id', '=', 'customers.id')
            ->where('subscriptions.agent_id','=',$agent_id)
            ->select('*')
            ->get();
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

         $request->session()->put('Subscription', $users)  ;




    $pdf =  App::make('dompdf.wrapper');

    $pdf-> loadView("models.modelstatistics", compact('Subscription','users'))->setPaper('a4', 'landscape');

    $pdf-> save(storage_path().'/app/public/statistics/statistics.pdf');

    return view("pages.statistics", compact("Subscription",'users'));
}

//
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
    public function create()
    {
        //
        return view('pages.Customers');

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
        $parameters=$request->except(['_token','numerodossier']);

        //var_dump($parameters); die;
        Customer::create($parameters);

        return redirect()->route('customers.list')->with('Client enregistré avec succès!!');

    }



    /**
     * Display the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(customer $customer)
    {
        //
        $customer->subscriptions;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(customer $customer)
    {
        //
    }
}
