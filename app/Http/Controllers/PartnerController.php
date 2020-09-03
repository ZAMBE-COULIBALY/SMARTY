<?php

namespace App\Http\Controllers;

use App\Mail\newPartner;
use App\Manager;
use App\Partner;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str as Str;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $partners = Partner::all();
        return view('pages.partners',compact('partners'));
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
            'code' => 'required|unique:partners|max:255',
            'label' => 'required|unique:partners|max:255',
            'email' => 'email'
        ]);

        $partner = new Partner();
        $partner->code = $parametersvalid['code'];
        $partner->label = $parametersvalid['label'];
        $partner->email = $parametersvalid['email'];
        $partner->contact = $parameters['contact'] ;
        $partner->state = isset($parameters['state']) ? 1 : 0 ;

        $date = new \DateTime(null);
        $partner->slug = Str::slug($parametersvalid['label'].$date->format('dmYhis'));

        $partner->admin_id = 0 ;
        $partner->save();

        $partnerManager = new Manager();
        $partnerManager->code = Str::random(5);
        $partnerManager->username = Str::slug($parametersvalid['label']."manager");
        $partnerManager->partner_id = $partner->id;
        $partnerManager->state = 1;
        $partnerManager->slug = Str::slug($partnerManager->username.$date->format('dmYhis'));

        $partnerManager->save();

        $partner->admin_id = $partnerManager->id ;
        $partner->save();

        $partnerManagerUser = new User();
        $partnerManagerUser->name = $parametersvalid['label']." Manager";
        $partnerManagerUser->username = $partnerManager->username;
        $partnerManagerUser->email = $partner->email;
        $partnerManagerUser->state = 1;
        $pass  = Str::random(8);
        $partnerManagerUser->password = Hash::make($pass);
        $partnerManagerUser->slug = $partnerManager->slug;
        $partnerManagerUser->save();
        $roles = ["Manager"];
        foreach ($roles as $role):
            $partnerManagerUser->roles()->attach(Role::where('label',$role)->first());
        endforeach;
        $partners = Partner::all();

      Mail::to($partner->email,"Armand N'DAH")

      ->queue(new newPartner($partner,$partnerManager,$pass))  ;

        return Redirect()->route('partners.list')->with('success',"Le partenaire a été correctement créé");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partner $partner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        //
    }
}
