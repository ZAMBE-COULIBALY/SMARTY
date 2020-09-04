<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Str as Str;


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
        $agencies = Agency::all();
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
            'code' => 'required|unique:agencies|max:255',
            'label' => 'required|unique:agencies|max:255',
            'email' => 'required|email',
            'address' => 'required'
        ]);

        $agency = new Agency();
        $agency->code = $parametersvalid['code'];
        $agency->label = $parametersvalid['label'];
        $agency->email = $parametersvalid['email'];
        $agency->address = $parametersvalid['address'];
        $agency->contact = $parameters['contact'] ;
        $agency->partner_id = $parameters['partner'] ;
        $agency->state = isset($parameters['state']) ? 1 : 0 ;
        $date = new \DateTime(null);
        $agency->slug = Str::slug($parameters['label'].$date->format('dmYhis'));

        $agency->save();

        return Redirect()->route('agency.list')->with('success',"l'agence a été correctement ajoutée");

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
    public function edit( $agency)
    {
        //
        $agencies = Agency::all();
        $partners = Partner::all();
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
            'label' => ['required','unique:agencies','max:255'],
            'email' => 'required|email',
            'address' => 'required'
        ]);
        $agency->code = $parameters['code'];
        $agency->label = $parametersvalid['label'];
        $agency->email = $parametersvalid['email'];
        $agency->address = $parametersvalid['address'];
        $agency->contact = $parameters['contact'] ;
        $agency->partner_id = $parameters['partner'] ;
        $agency->state = isset($parameters['state']) ? 1 : 0 ;

        $agency->save();

        return Redirect()->route('agency.list')->with('success',"l'agence a été correctement modifiée");

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
