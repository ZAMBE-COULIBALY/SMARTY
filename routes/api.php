<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/paiementmobile', [
    'as'=> 'paiementmobile',
    'uses' => 'SubscriptionController@paiementmobile'
    ]);

    Route::get('/subscription/demand/{demand}/validate', [
        'as'=> 'subscription.demand.validate',
        'uses' => 'DemandController@validated'
        ]);

        Route::get('/subscription/demand/{demand}/cancel', [
            'as'=> 'subscription.demand.cancel',
            'uses' => 'DemandController@canceled'
            ]);



    Route::post('/documentmobilepayment', [
        'as'=> 'documentmobilepayment',
        'uses' => 'SubscriptionController@documentmobilepayment'
        ]);

Route::get('/vocabulary/allVocbularySons/{vocabulary}',[
    "as" => "vocabularies.allforonevocabulary",
    "uses" => "VocabularyController@allForOneVocabulary"
]);

Route::get('/vocabulary/allForOneVocabularyFromPartner/{vocabulary}/{level}/{partner}',[
    "as" => "vocabularies.allForOneVocabularyFromPartner",
    "uses" => "VocabularyController@allForOneVocabularyFromPartner"
]);

Route::get('/document',[
    "uses" => 'HomeController@doc'
]);

Route::post('/stats',[
    "uses" => 'StatistiquesController@allSubscriptionsByAgency'
]);

Route::get('/dashboardData',[
    "uses" => "HomeController@dashboardData"
]);
