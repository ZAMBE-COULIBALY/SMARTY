<?php

namespace App\Http\Controllers;

use App\Intermediary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class IntermediaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $intermediaries = Intermediary::all();
        return view("pages.intermediaries",compact("intermediaries"));
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
               'email' => 'email',
            ]);

            try {
                //code...
                        $intermediary = new Intermediary();
                    $date = new Carbon();
                    $intermediary->code =  "C". Str::padLeft(Intermediary::all()->count()+1,4,"0") ;
                    $intermediary->firstname = $parameters['firstname'];
                    $intermediary->lastname = $parameters['lastname'];
    
                    $intermediary->contact = $parameters['contact'] ;
                    $intermediary->email = $parameters['email'] ;
                   
                    $intermediary->save();
                    Log::info('ok intermediary : '.json_encode($intermediary));

                } catch (\Throwable $th) {
                    throw $th;
                }
                return redirect()->route("businessman.list");


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Intermediary  $intermediary
     * @return \Illuminate\Http\Response
     */
    public function show(Intermediary $intermediary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Intermediary  $intermediary
     * @return \Illuminate\Http\Response
     */
    public function edit(Intermediary $intermediary)
    {
        //
        $intermediaries = Intermediary::all();
        return view("pages.intermediaries",compact("intermediaries","intermediary"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Intermediary  $intermediary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Intermediary $intermediary)
    {
        //
        $parameters = $request->except("_token");
        $oldintermediary = clone $intermediary;

        $parametersv = $request->validate([
               'email' => 'email',
            ]);

            try {
                //code...
                    $intermediary->firstname = $parameters['firstname'];
                    $intermediary->lastname = $parameters['lastname'];
    
                    $intermediary->contact = $parameters['contact'] ;
                    $intermediary->email = $parameters['email'] ;
                   
                    $intermediary->save();
                    Log::info('ok intermediary : '.json_encode($intermediary));

                } catch (\Throwable $th) {
                    throw $th;
                }
                return redirect()->route("businessman.list");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Intermediary  $intermediary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Intermediary $intermediary)
    {
        //
    }
}
