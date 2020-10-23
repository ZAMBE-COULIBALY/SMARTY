<?php

namespace App\Http\Controllers;

use App\ClaimsManager;
use App\Mail\newClaimsManager;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;


class ClaimsManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $claimsManagers = ClaimsManager::all();
        return view("pages.claimsManagers",compact("claimsManagers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

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
        $parameters = $request->except("_token");
        $parametersv = $request->validate([
            'code' =>
                ['required', 'unique:claimsmanagers,code',
                'max:255'
                ],
                'username' => ['required',
                'max:255', Rule::notIn(User::all()->pluck("username"))
                        ],
                'email' => 'required|email',
            ]);
        try {
            //code...
                    $claimsManager = new ClaimsManager();
                $date = new Carbon();
                $claimsManager->code = $parameters['code'];
                $claimsManager->firstname = $parameters['firstname'];
                $claimsManager->lastname = $parameters['lastname'];
                $claimsManager->username = $parameters['username'];

                $claimsManager->contact = $parameters['contact'] ;
                $claimsManager->state = isset($parameters['state']) ? 1 : 0 ;
                $claimsManager->slug = Str::slug($claimsManager->username.$date->format('dmYhis'));
               
                Log::info('ok claimsmanager : '.json_encode($claimsManager));


                $claimsManageruser = new User();
                $claimsManageruser->name = $claimsManager->lastname.' '.$claimsManager->firstname;
                $claimsManageruser->username = $claimsManager->username;
                $claimsManageruser->email = $parameters['email'];
                $claimsManageruser->slug = $claimsManager->slug;
                $claimsManageruser->state = $claimsManager->state;
                $pass  = Str::random(8);
                $claimsManageruser->password = Hash::make($pass);
                $claimsManageruser->save();
                $claimsManageruser->roles()->attach(Role::where('slug','claims_manager')->first());
                $claimsManager->save();

                Log::info('ok user claimsmanager : '.json_encode($claimsManageruser));
           try {
               //code...
                Mail::to($claimsManageruser->email,"claimsManager ".$claimsManager->lastname." ".$claimsManager->firstname)

                ->send(new newClaimsManager($claimsManager,$claimsManageruser,$pass))  ;
                Log::info('ok mail claimsmanager');
           } catch (\Throwable $th) {
               throw $th;
           }
               

                Session::Put('success',"le gestionnaire a été correctement créé");

        } catch (\Throwable $th) {
            throw $th;
            Log::info("Erreur lors de la création du gestionnaire. gestionnaire: ". json_encode($claimsManager). " | ".now());
            Session::Put("error","Erreur lors de la création du gestionnaire");        }


        return Redirect()->route('sinister.claimsManager.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClaimsManager  $claimsManager
     * @return \Illuminate\Http\Response
     */
    public function show(ClaimsManager $claimsManager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClaimsManager  $claimsManager
     * @return \Illuminate\Http\Response
     */
    public function edit(ClaimsManager $claimsManager)
    {
        //
        $claimsManagers = ClaimsManager::all();
        return view("pages.claimsManagers",compact("claimsManagers","claimsManager"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClaimsManager  $claimsManager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClaimsManager $claimsManager)
    {
        //
        $parameters = $request->except("_token");
        $parameters = $request->except("_token");
        $oldclaimsManager = clone $claimsManager;
        $parametersvalid = $request->validate([
            'username' =>  [
                'required','max:255', Rule::notIn(claimsManager::all()->except($oldclaimsManager->id)->pluck("username"))],
            'email' => 'required|email',
        ]);
        try {
            //code...
            $claimsManager->firstname = $parameters['firstname'];
            $claimsManager->lastname = $parameters['lastname'];
            $claimsManager->state = isset($parameters['state']) ? 1 : 0 ;
            $claimsManager->contact = $parameters['contact'] ;
            $claimsManageruser = $claimsManager->user;
            $claimsManageruser->name = "$parameters[firstname] $parameters[lastname]";
            $claimsManageruser->email = $parameters['email'];
            $claimsManageruser->state = isset($parameters['state']) ? 1 : 0 ;
            $claimsManageruser->save();


            $claimsManager->save();
            Session::Put('success',"Le gestionnaire a été correctement modifié");

          

        } catch (\Throwable $th) {
            throw $th;
            Log::info("Erreur lors de la modiication du gestionnaire. gestionnaire: ". json_encode($claimsManager). " | ".now());
            Session::Put("error","Erreur lors de la modiication du gestionnaire");        
        }


        return Redirect()->route('sinister.claimsManager.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClaimsManager  $claimsManager
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClaimsManager $claimsManager)
    {
        //
    }
}
