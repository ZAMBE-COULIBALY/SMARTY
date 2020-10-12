<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
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
}
