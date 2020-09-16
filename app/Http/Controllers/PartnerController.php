<?php

namespace App\Http\Controllers;

use App\Agency;
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
use Illuminate\Validation\Rule;

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
            'email' => 'required|email'
        ]);

        $partner = new Partner();
        $partner->code = $parametersvalid['code'];
        $partner->label = Str::upper(Str::lower(Str::upper($parametersvalid['label']))) ;
        $partner->email = $parametersvalid['email'];
        $partner->contact = $parameters['contact'] ;
        $partner->state = isset($parameters['state']) ? 1 : 0 ;

        $date = new \DateTime(null);
        $partner->slug = Str::slug($partner->label.$date->format('dmYhis'));

        $partner->admin_id = 0 ;
        $partner->save();

        $partnerManager = new Manager();
        $partnerManager->code = Str::random(5);
        $partnerManager->username = "manager@".Str::slug(Str::lower($partner->label),"_","fr");
        $partnerManager->partner_id = $partner->id;
        $partnerManager->state = 1;
        $partnerManager->slug = Str::slug($partnerManager->username.$date->format('dmYhis'));

        $partnerManager->save();

        $partner->admin_id = $partnerManager->id ;
        $partner->save();

        $partnerManagerUser = new User();
        $partnerManagerUser->name = $partner->label." Manager";
        $partnerManagerUser->username = $partnerManager->username;
        $partnerManagerUser->email = $partner->email;
        $partnerManagerUser->state = 1;
        $pass  = Str::random(8);
        $partnerManagerUser->password = Hash::make($pass);
        $partnerManagerUser->slug = $partnerManager->slug;
        $partnerManagerUser->partner_id = $partner->id;
        $partnerManagerUser->save();
        $roles = ["manager"];
        foreach ($roles as $role):
            $partnerManagerUser->roles()->attach(Role::where('slug',$role)->first());
        endforeach;
        $partners = Partner::all();

      Mail::to($partner->email,$partner->label." Manager")

      ->send(new newPartner($partner,$partnerManager,$pass))  ;

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
    public function edit($partner)
    {
        //
        $partners = Partner::all();
        $partner = Partner::where("slug","=",$partner)->first();
        return view('pages.partners',compact('partners','partner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $partner)
    {
        //
        $partner = Partner::where('slug','=',$partner)->first();
        $parameters = $request->except("_token");
        $oldpartner = clone $partner;
        $parametersvalid = $request->validate([
            'label' => [
                'required','max:255', Rule::notIn(Partner::all()->except($oldpartner->id)->pluck("label"))],
                'email' => 'required|email',
            // 'email' => ['required','email', Rule::notIn(Partner::all()->except($oldpartner->id)->pluck("email"))],
            'contact' => 'required'
        ]);

        $partner->label = Str::upper(Str::lower(Str::upper($parametersvalid['label']))) ;
        $partner->email = $parametersvalid['email'];
        $partner->contact = $parametersvalid['contact'] ;
        $partner->state = isset($parameters['state']) ? 1 : 0 ;

        $partner->save();
        return Redirect()->route('partners.list')->with('success','Le partenaire a été ecorrectement modifié');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy($partner)
    {
        //
        $partner = Partner::where('slug','=',$partner)->first();
        if(0 !== Agency::all()->where("partner_id","=",$partner->id)->count())
        return Redirect()->route('partners.list')->with('error','Le partenaire a des PDV et ne peut être supprimé');



        $partnerManagers = Manager::all()->where("partner_id",$partner->id);
        foreach ($partnerManagers as $manager) {
            # code...
            $managerUser = User::where("username","=",$manager->username)->first();
            $managerUser->delete();
            $manager->delete();
        }
        $partner->delete();
        return Redirect()->route('partners.list')->with('success','Le partenaire a été correctement supprimé');
    }
}
