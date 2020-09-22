<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Agent;
use App\Mail\newAgent;
use App\Role;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str as Str;


class AgentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('roles');
        // $this->middleware('auth');
        }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $agents = Agent::all()->where("agency_id",Agent::where("username",Auth::user()->username)->first()->agency->id);
        $agencies = Agency::all()->where("chief_id",Agent::where("username",Auth::user()->username)->first()->id);
        return view("pages.agents",compact('agents','agencies'));
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

        try {
            //code...
                    $agent = new Agent();
                $date = new DateTime(null);
                $agent->code = $parameters['code'];
                $agent->firstname = $parameters['firstname'];
                $agent->lastname = $parameters['lastname'];
                $agent->username = $parameters['username'];
                $agent->agency_id = Agent::where("username",Auth::user()->username)->first()->agency->id;

                $agent->contact = $parameters['contact'] ;
                $agent->state = isset($parameters['state']) ? 1 : 0 ;
                $agent->slug = Str::slug($agent->username.$date->format('dmYhis'));


                $agentuser = new User();
                $agentuser->name = $agent->lastname.' '.$agent->firstname;
                $agentuser->username = $agent->username;
                $agentuser->email = $parameters['email'];
                $agentuser->name = $agent->lastname.' '.$agent->firstname;
                $agentuser->slug = $agent->slug;
                $agentuser->state = $agent->state;
                $pass  = Str::random(8);
                $agentuser->password = Hash::make($pass);
                $agentuser->save();
                $agentuser->roles()->attach(Role::where('slug','agent')->first());
                $agent->save();
                Mail::to($agentuser->email,"Agent ".$agent->lastname." ".$agent->firstname)

                ->send(new newAgent($agent,$agent->agency,$pass))  ;


        } catch (\Throwable $th) {
            throw $th;
        }


        return Redirect()->route('agents.list')->with('success',"L'agent a été correctement créé");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(Agent $agent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        //
        $agents = Agent::all();
        $agent = Agent::where('slug','=',$slug)->first();
        $agencies = Agency::all();

        return view('pages.agents',compact('agents','agencies','agent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$slug)
    {
        //
        $agent = Agent::where('slug','=',$slug)->first();
        $parameters = $request->except("_token");
        $oldagent = clone $agent;
        $agent->firstname = $parameters['firstname'];
        $agent->lastname = $parameters['lastname'];
        $agent->state = isset($parameters['state']) ? 1 : 0 ;
        $agent->contact = $parameters['contact'] ;
        $agentuser = $agent->user;
        $agentuser->name = "$parameters[firstname] $parameters[lastname]";
        $agentuser->email = $parameters['email'];
        $agentuser->state = isset($parameters['state']) ? 1 : 0 ;
        $agentuser->save();


        $agent->save();

        return Redirect()->route('agents.list')->with('success',"L'agent a été correctement modifié");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        //
        $agent = Agent::where('slug','=',$slug)->first();
        $agent->delete();
        return Redirect()->route('agents.list')->with('success',"L'agent a été correctement supprimé");


    }


    public function allforonejson($agency)
    {
        # code...
        $agents = Agent::all()->where('agency_id',$agency);
        return response()->json($agents);
    }
}
