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
    Route::get('/', [
        'as'=> 'subscription.list',
        'uses' => 'SubscriptionController@index'
        ]);
    Route::get('/new', [
        'as'=> 'subscription.create',
        'uses' => 'SubscriptionController@create'
        ]);

    Route::get('/add', [
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
Route::get('/customers', [
    'as'=> 'customers',
    'uses' => 'CustomerController@create'
    ]);

Route::get('/customers/{id}', [
    'as'=> 'showCustomers',
    'uses' => 'CustomerController@show'
    ]);

Route::get('/customers/{id}', [
    'as'=> 'updateCustomers',
    'uses' => 'CustomerController@update'
    ]);

Route::get('/customers/{id}', [
    'as'=> 'editCustomers',
    'uses' => 'CustomerController@edit'
    ]);

// fin Liens Customers
