<?php

namespace App\Http\Controllers;

use App\Sinister;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\database\Query\Builder;
use Illuminate\Support\Facades\App;
use App\User;
use App\Customer;
use App\Subscription;
use App\Agency;
use App\Agent;
use App\payments;
use App\Manager;
use App\Partner;
use App\Product;
use App\Role;
use App\Vocabulary;
use App\VocabularyType;
use Illuminate\Support\Facades\Input;
use phpDocumentor\Reflection\DocBlock\Tags\Since;

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
        $libellepdv = Agency::Where("id",Agent::where("username","=",Auth()->user()->username)->first()->agency_id)->first()->label;

        $validatedData = $request->validate([
            'folder'=> 'required|exists:subscriptions,code',
        ]);

        $Subscription = Subscription::where('code','=',$validatedData['folder'])->first();


        return view('pages.detailSearch',compact('Subscription'));
     }


    public function create(Request $request,Subscription $subscription)
    {
        //
// dd($subscription->agent);
        return view('pages.declareSinister',compact('subscription',$subscription));
    }


    public function getvalid(Request $request,Subscription $subscription)
    {
        //
        return view('pages.valid',compact('subscription',$subscription));
    }

    public function valid(Request $request,Subscription $subscription)
    {
        //

        DB::update('update sinisters set state = 1 where folder = ?', [$subscription->code]);

        $listsinistres = DB::table('sinisters')
        ->join('subscriptions', 'subscriptions.code', '=', 'sinisters.folder')
        ->join('customers','subscriptions.customer_id', '=', 'customers.id')
        ->select('*')
        ->where('sinisters.state','=',1)
        ->get();

        $sinister = Sinister::where("folder","=",$subscription->code)->where('state', '=',1)->first();

        $Subscription = $request->session()->get('Subscription');
        //$Subscription = Subscription::where('code','=',[$subscription->code])->first();
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

        $user= Auth()->user()->username;

        $pdf =  App::make('dompdf.wrapper');

        $pdf-> loadView("models.model_bon", compact('subscription',$sinister));

        $pdf-> save(storage_path().'/app/public/voucher/'.$subscription->code.'.pdf');

        return view('pages.listeSinistreValidate',compact('subscription',$subscription))->with('liste', $listsinistres) ;
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Subscription $subscription)
    {
        //

        $paramters =$request->except('_token');
        $contract = $paramters['contract'];
        $vouchers = $paramters['vouchers'];
            if (null !== $request->file('contract') && null !== $request->file('vouchers')) {
                # code...

                $contract = "contract-".$subscription->code."-". time() . '.' . $request->file('contract')->getClientOriginalExtension();
                $request->file('contract')->storeAs('sinisters/'.$subscription->code.'/', $contract);


                $vouchers = "vouchers-".$subscription->code."-". time() . '.' . $request->file('vouchers')->getClientOriginalExtension();
                $request->file('vouchers')->storeAs('sinisters/'.$subscription->code.'/', $vouchers);


            }
        Sinister::create([
            'code'=>$subscription->code,
            'folder' =>$subscription->code,
            'description'=>$paramters['description'],
            'contract'=>$contract,
            'vouchers'=>$vouchers,
            'state'=>"0",
            'type1'=>(isset($paramters['choix1']))  ? collect($paramters['choix1'])->implode('-'): "",
            'type2'=> (isset($paramters['choix2'])) ? collect($paramters['choix2'])->implode('-') : "",
        ]);

        return redirect(route('sinister.list'))->with('success','déclaration transmise');
    }

    public function getbon(Request $request ,Subscription $subscription)
    {
        //
       // dd($subscription->code);


        $Subscription = $request->session()->get('subscription');

        return view('pages.bon',compact('subscription'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sinister  $sinister
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request )
    {
        //
        $listsinistres = Sinister::all()
        ->where('state',0);
        // dd($listsinistres);
                $Subscription = $request->session()->get('Subscription');
        return view('pages.listeSinistre',compact('Subscription'))->with('liste', $listsinistres) ;
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

    public function manageDemandList()
    {
        # code...
        $sinisters = Sinister::all()->where("state",0);
        $step = "DL";
        return view("pages.sinisters",compact("sinisters","step"));
    }

    public function manageDemandDetails(Sinister $sinister)
    {
        # code...
        $step = "DD";
        return view("pages.sinisters",compact("sinister","step"));
    }
}
