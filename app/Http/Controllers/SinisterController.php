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
use App\Mail\newSinister;
use App\payments;
use App\Manager;
use App\Partner;
use App\Product;
use App\Role;
use App\Vocabulary;
use App\VocabularyType;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\DocBlock\Tags\Since;
use Illuminate\Support\Str;


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

        $subscription = Subscription::where('code','=',$validatedData['folder'])->first();


        return redirect()->route("sinister.create",$subscription->id);
     }


    public function create(Subscription $subscription)
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

        $parametersvalid = $request->validate([
            'description' => 'required|max:750',
            'contract' => 'required|image',
            'vouchers' => 'required|image',
            'type1' => 'sometimes|required',
            'type2' => 'sometimes|required',
        ]);
try {
    //code...
    $contract = $paramters['contract'];
    $vouchers = $paramters['vouchers'];
        if (null !== $request->file('contract') && null !== $request->file('vouchers')) {
            # code...

            $contract = "contract-".$subscription->code."-". time() . '.' . $request->file('contract')->getClientOriginalExtension();
            $request->file('contract')->storeAs('public/sinisters/'.$subscription->code.'/', $contract);


            $vouchers = "vouchers-".$subscription->code."-". time() . '.' . $request->file('vouchers')->getClientOriginalExtension();
            $request->file('vouchers')->storeAs('public/sinisters/'.$subscription->code.'/', $vouchers);


        }
        $code = Str::random(14);
    Sinister::create([
        'code'=> $code,
        'folder' =>$subscription->code,
        'description'=>$paramters['description'],
        'contract'=>$contract,
        'vouchers'=>$vouchers,
        'state'=>"0",
        'type1'=>(isset($paramters['choix1']))  ? collect($paramters['choix1'])->implode('-'): "",
        'type2'=> (isset($paramters['choix2'])) ? collect($paramters['choix2'])->implode('-') : "",
    ]);

   $sinister = Sinister::where("code",$code)->first();
    $agent = Agent::where("username",Auth::user()->username);
        // Mail::to(explode(",",env("MAIL_SINISTERS_MANAGER")))->send(new newSinister($sinister,$agent));
        Session::put('success','Déclaration de sinistre transmise');
    } catch (\Throwable $th) {
        Log::error(json_encode($th));
        Session::put('error','Erreur lors de la déclaration de sinistre');

    }

        return redirect(route('sinister.list'));
    }

    public function getbon(Request $request ,Sinister $sinister)
    {
        //
       // dd($subscription->code);


        $Subscription = $request->session()->get('subscription');

        return view('pages.bon',compact('sinister'));
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
        $listsinistres = Sinister::all();
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

    public function manageDemandState(Sinister $sinister,$state)
    {
        # code...
        try {
            //code...
            $sinister->state = $state;
            $sinister->save();
            if ($state == 1) {
                # code...


                $user= Auth()->user()->username;

                $pdf =  App::make('dompdf.wrapper');

                $pdf-> loadView("models.model_bon", compact('sinister'));

                $pdf-> save(storage_path().'/app/public/voucher/'.$sinister->folder.$sinister->id.'.pdf');
            }
            Session::Put('success',"Demande traitée avec succès!");
        } catch (\Throwable $th) {
            throw $th;
            Session::Put('error',"Erreur lors du  traitement de la demande!");
Log::info(json_encode($th));
        }

        return redirect()->route("sinister.manage.demandlist");

}
}
