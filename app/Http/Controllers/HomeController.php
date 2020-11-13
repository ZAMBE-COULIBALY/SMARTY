<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('layouts/layout');
    }
    public function error()
    {
        return view('shared.error');
    }
    public function dashboard(Request $requet)
    {
        Log::emergency('appel fonction à '.now());
        Log::alert('appel fonction à '.now());
        Log::critical('appel fonction à '.now());
        Log::error('appel fonction à '.now());
        Log::warning('appel fonction à '.now());
        Log::notice('appel fonction à '.now());
        Log::info('appel fonction à '.now());
        Log::debug('appel fonction à '.now());
        # code...
        return view('layouts.layout');
    }

    public function changePassword()
    {
        # code...
        return view("auth.passwords.change");
    }

    public function postChangePassword(Request $request)
    {
        # code...
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = User::where("username",Auth::user()->username)->first() ;
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");

    }

    public function doc()
    {
        # code...
        $pdf =  App::make('dompdf.wrapper');

            $pdf-> loadView("models.document1");
            $pdf-> save(storage_path().'/app/public/received/document.pdf');

// Output the generated PDF to Browser
            $pdf->stream(storage_path().'/app/public/received/document.pdf');
    }


    public function dashboardData()
    {
        # code...

        $subscription100 = 0;
        $subscription70 = 0;
        $subscription50 = 0;
        $subscription25 = 0;
        $subscriptionWin = 0;
        $subscriptionFull = 0;
        $subscriptionLost = 0;
        $subscriptionCurPrime =Subscription::all()->where("subscription_enddate",">",now()->floorday())->sum("premium");
        $subscriptions = Subscription::all();

        foreach ($subscriptions->where("subscription_enddate",">",now()->floorday())->where('formula',"<>","1")->where("state","<>",0) as $subscription ) {
            # code...
            switch ($subscription->currentState()) {
                case 1:
                    # code...
                    $subscription100 = $subscription100 + $subscription->currentValue();

                    break;
            
                case 2:
                    # code...
                    $subscription70 = $subscription70 + $subscription->currentValue();

                    break;
                case 3:
                    # code...
                    $subscription50 = $subscription50 + $subscription->currentValue();

                    break;
                    case 1:
                        # code...
                        $subscription100 = $subscription100 + $subscription->currentValue();
    
                        break;
                default:
                    # code...
                    break;
            }


        }


        foreach ($subscriptions->where("subscription_enddate",">",now()->floorday())->where('formula',"1")->where("state","<>",0) as $subscription ) {
            $subscription25 = $subscription25 + $subscription->currentValue();

        }
        foreach ($subscriptions->where("state",0) as $subscription ) {
            $subscriptionLost = $subscriptionLost + $subscription->currentValue();

        }
      

        $subscriptionFull = $subscription100  + $subscription70 + $subscription50 + $subscription25;

        $subscriptionWin = $subscriptions->where("state","<>",0)->where("subscription_enddate","<",now()->floorday())->sum("premium");

        $data = [
            "general" => [ 
                "subscriptionFull" => $subscriptionFull,
                "subscription100" => $subscription100,
                "subscription70" => $subscription70,
                "subscription50" => $subscription50, 
                "subscription25" => $subscription25, 
                "subscriptionWin" => $subscriptionWin, 
                "subscriptionLost" => $subscriptionLost, 
                "subscriptionCurPrime" => $subscriptionCurPrime, 
                ]
           
        ];

       
        $subscriptions = Subscription::whereBetween("date_subscription",[now()->copy()->firstOfYear()->floorDay(),now()->copy()->addDay(1)->floorDay()->addSecond(-1)])->select(DB::raw('count(id) as `data`'),DB::raw("DATE_FORMAT(date_subscription, '%m') new_date"))
        ->groupBy('new_date')->get();

        $cpt = ["01" => 0,"02" => 0,"03" => 0,"04" => 0,"05" => 0,"06" => 0,"07" => 0,"08" => 0,"09" => 0,"10" => 0,"11" => 0,"12" => 0];
        foreach ($subscriptions as $subscription ) {
            $cpt[$subscription->new_date] = $cpt[$subscription->new_date] + $subscription->data;
        }
        $cpt1 = [];
        foreach ($cpt as $key => $value) {
            # code...
            array_push($cpt1,(integer)$value);
        }
        $month = now()->month;
        $data["globalMonthlySubCount"] =  array_slice($cpt1,0,(integer)$month);
        /// Data Chart Global Monthly Subscription count




        // return
        return response()->json($data);
    }
}
