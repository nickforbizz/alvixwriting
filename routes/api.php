<?php

use Illuminate\Http\Request;

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

Route::get('/', function(){
    return "API";
});

Route::group(['as' => 'api.', 'namespace' => 'Api', 'middleware' => 'api'], function () {

    Route::post('/access/temp', 'AccessController@temporal')->name('access.temp');
    Route::post('/access/register', 'AccessController@register')->name('access.register');
    Route::post('/access/login', 'AccessController@login')->name('access.login');

});

Route::group(['as' => 'api.', 'namespace' => 'Api', 'middleware' => 'webby'], function () {

    Route::post('/profile/update', 'ProfileController@update')->name('profile.update');


});

Route::group(['prefix' => 'calls', 'as' => 'calls.', 'namespace' => 'Calls', 'middleware' => 'calls'], function () {

    Route::post('/payment/received', 'InPaymentsController@processInPayment')->name('payment.received');

});
