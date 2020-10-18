<?php

namespace App\Http\Controllers;

use App\Agency;
use App\Agent;
use App\Manager;
use App\Subscription;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatistiquesController extends Controller
{
    //


    public function subscriptionsByAgency()
    {
        # code...


        if (User::where("username","=",Auth()->user()->username)->first()->hasRole("manager")) {
            # code...
            $agencies = Agency::all()->where("partner_id",Manager::where("username",Auth()->user()->username)->first()->partner_id);

        } else {
            # code...
            $agencies = Agency::all()->where("id",Agent::where("username","=",Auth()->user()->username)->first()->agency_id);


        }

        return view("pages.etat", compact('agencies'));
    }

    public function allSubscriptionsByAgency(Request $request)
    {
        # code...
        $parameters = $request->except("_token");

        $parametersvalid = $request->validate([
            "agency" => "exists:agencies,id",

        ]);


        $startdate =  Carbon::parse(date_create_from_format("d/m/Y",$parameters["startdate"]))->floorday();
        $enddate = Carbon::parse(date_create_from_format("d/m/Y",$parameters["enddate"] ))->addDay(1)->floorday()->addSecond(-1);
        $agency = Agency::where("id",$parametersvalid["agency"])->first();

        if (User::where("username","=",Auth()->user()->username)->first()->hasRole("manager")) {
            # code...
            $agencies = Agency::all()->where("partner_id",Manager::where("username","=",Auth()->user()->username)->first()->partner_id);

        } else {
            # code...
            $agencies = Agency::all()->where("id",Agent::where("username","=",Auth()->user()->username)->first()->agency_id);


        }
        $collection = Subscription::all()->whereBetween("created_at",[$startdate,$enddate])
                ->whereIn("agent_id",$agency->agents->pluck("id"));
                return view("pages.etat", compact('agencies','collection'));
            }
}
