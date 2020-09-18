<?php

use Illuminate\Support\Facades\Auth;
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
})->middleware('auth');;

Auth::routes();

Route::get('/home', [
'as'=> 'home',
'uses' => 'HomeController@index'
])->middleware('auth');;



Route::get('/ChangePassword', [
    'as' => 'password.change',
    'uses' => 'HomeController@changePassword'
]
)->middleware('auth');

Route::post('/ChangePassword', [
    'as' => 'password.change.validate',
    'uses' => 'HomeController@postChangePassword'
]
)->middleware('auth');

Route::get('/error',
[
    'as' => 'error',
'uses' => 'HomeController@error'
]
)->middleware('auth');

Route::get('/dashboard', [
    'as' => 'dashboard',
    'uses' => 'HomeController@dashboard'
]
)->middleware('auth');

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
Route::group(['prefix' => '/statistics', 'middleware' => ["auth","roles"],], function () {
    Route::get('/', [
        'as'=> 'statistics.show',
        'uses' => 'CustomerController@getstatistics'
        ]);
        Route::get('/PDF', [
            'as'=> 'statistics.etat',
            'uses' => 'CustomerController@statisticsPDF'
            ]);

        Route::get('/EXCEL', [
            'as'=> 'statistics.excel',
            'uses' => 'CustomerController@statisticsExcel'
            ]);

            Route::get('/etat', [
                'as'=> 'statistics.etatpartenaire',
                'uses' => 'CustomerController@etat'
                ]);

    });

    // sinister
    Route::group(['prefix' => '/sinister'], function () {
        Route::get('/', [
            'as'=> 'sinister.search',
            'uses' => 'SinisterController@index'
            ]);
            Route::get('/etat', [
                'as'=> 'sinister.index',
                'uses' => 'SinisterController@index'
                ]);

            Route::POST('/statment', [
                'as'=> 'sinister.statment',
                'uses' => 'SinisterController@statment'
                ]);



        });

        //end sinister


Route::group(['prefix' => '/partner', 'as' => 'partners.', 'middleware' => ["auth","roles"], "roles" => ["super_administrator"]], function () {
    Route::get('/', [
        'as'=> 'list',
        'uses' => 'PartnerController@index'
        ]);
    Route::get('/new', [
        'as'=> 'create',
        'uses' => 'PartnerController@create'
        ]);

    Route::post('/add', [
        'as'=> 'add',
        'uses' => 'PartnerController@store'
        ]);

    Route::get('/details/{id}', [
        'as'=> 'one',
        'uses' => 'PartnerController@show'
        ]);

    Route::post('/update/{id}', [
        'as'=> 'update',
        'uses' => 'PartnerController@update'
        ]);

    Route::get('/edit/{id}', [
        'as'=> 'edit',
        'uses' => 'PartnerController@edit'
        ]);

    Route::get('/delete/{id}', [
        'as'=> 'delete',
        'uses' => 'PartnerController@destroy'
        ]);

});


Route::group(['prefix' => '/agency', 'as' => 'agencies.', 'middleware' => ["auth","roles"], "roles" => ["manager"]], function () {
    Route::get('/', [
        'as'=> 'list',
        'uses' => 'AgencyController@index'
        ]);
    Route::get('/new', [
        'as'=> 'create',
        'uses' => 'AgencyController@create'
        ]);

    Route::post('/add', [
        'as'=> 'add',
        'uses' => 'AgencyController@store'
        ]);

    Route::get('/details/{agency}', [
        'as'=> 'one',
        'uses' => 'AgencyController@show'
        ]);

    Route::post('/update/{agency}', [
        'as'=> 'update',
        'uses' => 'AgencyController@update'
        ]);

    Route::get('/edit/{agency}', [
        'as'=> 'edit',
        'uses' => 'AgencyController@edit'
        ]);

    Route::get('/delete/{agency}', [
        'as'=> 'delete',
        'uses' => 'AgencyController@destroy'
        ]);

});

Route::group(['prefix' => '/Agent','middleware' => ['auth','roles']], function () {
    Route::get('/', [
        'as' => 'agents.list',
        'uses' => 'AgentController@index',
        'roles' => ['agent_chief']
    ]
    );

    Route::get('/show/{slug}', [
        'as' => 'agents.one',
        'uses' => 'AgentController@show',
        'roles' => ['agent_chief']
    ]
    );


    Route::post('/add', [
        'as' => 'agents.add',
        'uses' => 'AgentController@store',
        'roles' => ['agent_chief']
    ]
    );

    Route::get('/edit/{slug}', [
        'as' => 'agents.edit',
        'uses' => 'AgentController@edit',
        'roles' => ['agent_chief']
    ]
    );
    Route::post('/update/{slug}', [
        'as' => 'agents.update',
        'uses' => 'AgentController@update',
        'roles' => ['agent_chief']
    ]
    );
    Route::get('/delete/{slug}', [
        'as' => 'agents.delete',
        'uses' => 'AgentController@destroy',
        'roles' => ['agent_chief']
    ]
    );
});
//Liens Subscritpion
Route::group(['prefix' => '/subscription', 'middleware' => ["auth","roles"],], function () {

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

                        Route::get('/back', [
                            'as'=> 'subscription.precedent',
                            'uses' => 'SubscriptionController@precedent'
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

Route::group(['prefix' => '/customers', 'middleware' => ["auth","roles"], "roles" => ["manager","administrator","super_administrator"]], function () {
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


Route::group(['prefix' => '/product', 'as' => 'products.', 'middleware' => ["auth","roles"], "roles" => ["manager","administrator"]], function () {
    Route::get('/', [
        'as'=> 'list',
        'uses' => 'ProductController@index'
        ]);
    Route::get('/new', [
        'as'=> 'create',
        'uses' => 'ProductController@create'
        ]);

    Route::post('/add', [
        'as'=> 'add',
        'uses' => 'ProductController@store'
        ]);

    Route::get('/details/{id}', [
        'as'=> 'one',
        'uses' => 'ProductController@show'
        ]);

    Route::post('/update/{id}', [
        'as'=> 'update',
        'uses' => 'ProductController@update'
        ]);

    Route::get('/edit/{id}', [
        'as'=> 'edit',
        'uses' => 'ProductController@edit'
        ]);

    Route::get('/delete/{id}', [
        'as'=> 'delete',
        'uses' => 'ProductController@destroy'
        ]);

});
