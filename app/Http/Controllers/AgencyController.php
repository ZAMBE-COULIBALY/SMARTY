<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Agent;
use App\Mail\newAgency;
use App\Manager;
use App\Partner;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str as Str;
use Illuminate\Validation\Rule;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $agencies = Agency::all()->where("partner_id",Manager::where("username","=",Auth()->user()->username)->first()->partner_id);
        $partners = Partner::all();
        return view('pages.agency',compact('agencies','partners'));
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

        $parametersvalid = $request->validate([
            'code' =>
                    ['required',
                     Rule::notIn(Agency::all()->where("partner_id",Manager::where("username","=",Auth()->user()->username))->pluck("code")),
                     'max:255'
                    ],
            'label' => ['required',
            Rule::notIn(Agency::all()->where("partner_id",Manager::where("username","=",Auth()->user()->username))->pluck("label")),
            'max:255'
           ],
            'email' => 'required|email',
            'address' => 'required'
        ]);
            $agency = new Agency();
            $agencyChief = new Agent();
            $agencyChiefUser = new User();
            $pass  = Str::random(8);
              try {
                //code...

        $agency->code = Manager::where("username","=",Auth()->user()->username)->first()->partner->code.$parametersvalid['code'];
        $agency->label = $parametersvalid['label'];
        $agency->email = $parametersvalid['email'];
        $agency->address = $parametersvalid['address'];
        $agency->contact = $parameters['contact'] ;
        $agency->partner_id = Manager::where("username","=",Auth()->user()->username)->first()->partner_id ;
        $agency->state = isset($parameters['state']) ? 1 : 0 ;
        $agency->chief_id= 0;

        $date = new \DateTime(null);
        $agency->slug = Str::slug($parameters['label'].$date->format('dmYhis'));

        $agency->save();


        $agencyChief->code     = $agency->code.str_pad(Agency::all()->where("partner_id",$agency->partner->id)->count(),3,"0",STR_PAD_LEFT);
        $agencyChief->lastname= "Chief";
        $agencyChief->firstname= $parametersvalid['label'];
        $agencyChief->username=  "chief@".Str::slug($parametersvalid['label'],"_");
        $agencyChief->contact= $parameters['contact'];
        $agencyChief->agency_id= $agency->id;
        $agencyChief->state= true;
        $agencyChief->slug= Str::slug($agencyChief->username.$date->format('dmYhis'));
        $agencyChief->save();

        $agency->chief_id = $agencyChief->id;
        $agency->save();

        $agencyChiefUser->name = $parametersvalid['label']." Chief";
        $agencyChiefUser->username = $agencyChief->username;
        $agencyChiefUser->email = $agency->email;
        $agencyChiefUser->state = 1;

        $agencyChiefUser->password = Hash::make($pass);
        $agencyChiefUser->slug = $agencyChief->slug;
        $agencyChiefUser->partner_id = $agency->partner_id;

        $agencyChiefUser->save();
        $roles = ["agent_chief"];
        foreach ($roles as $role):
            $agencyChiefUser->roles()->attach(Role::where('slug',$role)->first());
        endforeach;
            } catch (\Throwable $th) {
                throw $th;
            }

        $partners = Agency::all();
       //dd($pass);
      Mail::to($agency->email,$agency->label." Chef PDV")

      ->send(new newAgency($agency,$agencyChief,$pass))  ;

        return Redirect()->route('agencies.list')->with('success',"Le PDV a été correctement créé");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function show(Agency $agency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function edit($agency)
    {
        //
        $agencies = Agency::all();
        $partners = Agency::all();
        $agency = Agency::where('slug','=',$agency)->first();
        return view('pages.agency',compact('agencies','agency','partners'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $agency)
    {
        //
        $agency = Agency::where('slug','=',$agency)->first();
        $parameters = $request->except("_token");
        $oldagency = clone $agency;
        $parametersvalid = $request->validate([
            'code' => ['required','max:255',],
            'label' =>  [
                'required','max:255', Rule::notIn(Agency::all()->except($oldagency->id)->pluck("label"))],
            'email' => 'required|email',
            'address' => 'required'
        ]);
        $agency->code = $parameters['code'];
        $agency->label = $parametersvalid['label'];
        $agency->email = $parametersvalid['email'];
        $agency->address = $parametersvalid['address'];
        $agency->contact = $parameters['contact'] ;
        $agency->partner_id = $oldagency->partner->id ;
        $agency->state = isset($parameters['state']) ? 1 : 0 ;

        $agency->save();

        return Redirect()->route('agencies.list')->with('success',"l'agence a été correctement modifiée");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agency $agency)
    {
        //
    }
}
