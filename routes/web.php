<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts/layout');
});

Auth::routes();

Route::get('/home', [
'as'=> 'home',
'uses' => 'HomeController@index'
]);


//Liens Subscritpion
Route::group(['prefix' => '/subscription'], function () {

    Route::get('/getcustomers', [
        'as'=> 'subscription.customer',
        'uses' => 'SubscriptionController@getcustomers'
        ]);

        Route::post('/postcustomer', [
            'as'=> 'subscription.postcustomer',
            'uses' => 'SubscriptionController@postcustomers'
            ]);

            Route::get('/getequipment', [
                'as'=> 'subscription.getequipment',
                'uses' => 'SubscriptionController@getequipment'
                ]);

            Route::post('/postequipment', [
                'as'=> 'subscription.postequipment',
                'uses' => 'SubscriptionController@postequipment'
                ]);

                Route::get('/recapitulatif', [
                    'as'=> 'subscription.recapitulatif',
                    'uses' => 'SubscriptionController@getrecapitulatif'
                    ]);


        Route::post('/storecustomer', [
            'as'=> 'subscription.storecustomer',
            'uses' => 'SubscriptionController@storecustomers'
            ]);

            Route::get('/recu', [
                'as'=> 'subscription.recu',
                'uses' => 'SubscriptionController@getrecu'
                ]);

                Route::get('/exportToPDF', [
                    'as'=> 'subscription.exportToPDF',
                    'uses' => 'SubscriptionController@exportToPDF'
                    ]);

                    Route::get('/proforma', [
                        'as'=> 'subscription.proforma',
                        'uses' => 'SubscriptionController@proforma'
                        ]);

    Route::get('/new', [
        'as'=> 'subscription.create',
        'uses' => 'SubscriptionController@create'
        ]);

    Route::post('/add', [
        'as'=> 'subscription.add',
        'uses' => 'SubscriptionController@store'
        ]);

    Route::get('/details/{id}', [
        'as'=> 'showSubscription.one',
        'uses' => 'SubscriptionController@show'
        ]);

    Route::get('/update/{id}', [
        'as'=> 'subscription.update',
        'uses' => 'SubscriptionController@update'
        ]);

    Route::get('/edit/{id}', [
        'as'=> 'subscription.edit',
        'uses' => 'SubscriptionController@edit'
        ]);

    Route::get('/delete/{id}', [
        'as'=> 'subscription.delete',
        'uses' => 'SubscriptionController@destroy'
        ]);

});

        //fin Liens Subscritpion

//Liens Customers

Route::group(['prefix' => '/customers'], function () {
    Route::get('/', [
    'as'=> 'customers.list',
    'uses' => 'CustomerController@index'
    ]);

 Route::get('/create', [
    'as'=> 'customers.create',
    'uses' => 'CustomerController@create'
    ]);

Route::post('/add', [
    'as'=> 'customers.add',
    'uses' => 'CustomerController@store'
    ]);

Route::get('/details/{id}', [
    'as'=> 'customers.one',
    'uses' => 'CustomerController@show'
    ]);

Route::get('/update/{id}', [
    'as'=> 'customers.update',
    'uses' => 'CustomerController@update'
    ]);

Route::get('/edit/{id}', [
    'as'=> 'customers.edit',
    'uses' => 'CustomerController@edit'
    ]);

Route::get('/delete/{id}', [
    'as'=> 'customers.delete',
    'uses' => 'CustomerController@destroy'
    ]);
});

// fin Liens Customers
