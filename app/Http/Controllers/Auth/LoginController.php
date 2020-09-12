<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Partner;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str as Str;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        # code...
        return 'username';
    }


     /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {

        if ($request->get("username") != "adminsmarty") {
            # code...
            $this->validatePartner($request);

            $partner = Partner::all()->where("label",Str::upper($request->get("partner")))->first()->id;

            return $this->guard()->attempt(
                $this->credentials($request) + ["partner_id" => $partner],
                $request->filled('remember')
            );
         }

         return $this->guard()->attempt(
            $this->credentials($request) ,
            $request->filled('remember')
        );


    }

    public function authentication(Request $request)
    {
        # code...
        $this->validatePartner($request);


    }

    protected function validatePartner(Request $request)
    {
        $request->validate([
            "partner" => ['required','string',
            Rule::exists("partners","label"),
            ]
        ]);
    }
}
