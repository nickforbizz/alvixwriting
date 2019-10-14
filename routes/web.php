<?php

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

use App\Models\User;
use App\Events\TestEvent;
use App\Events\userEvent;
use Illuminate\Http\Request;
use App\Events\SubscribeEvent;
use App\Mail\UpdatesSubscription;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Notifications\AssignmentChat;
use Illuminate\Support\Facades\Route;
use App\Notifications\TestNotification;
use App\Notifications\DefaultNotification;
use Illuminate\Support\Facades\Notification;
use bnjns\LaravelNotifications\Facades\Notify;

Route::get('/', function () {
    return view('web.root');
})->name('root');



// Reset Passwords

//Password writer reset routes
include ('inc_files/writer_passwd_resets.php');

//Password admin reset routes
include ('inc_files/admin_passwd_resets.php');



Route::get('/event', function () {

    Notification::send(\App\Models\Admin::where('status', 1)->get(), new DefaultNotification(\App\Models\Assignment::find(1)));
 
    event(new TestEvent);
    
    return "fired";

})->name('testNot');

Route::post('/Subscribe', function(Request $request){
    $email = $request->email;

     event(new SubscribeEvent($email));
    return $email;
});

Route::get('/event_view', function () {

return view("event_view");
});




Route::get('/klove/{toString}', "KloveController@index");
Route::get('WriterProfile/{id}', function ($id){
    $profile = \App\Models\User::find($id)->first();
    return $profile;
})->name('writerProfile');


//Route::resource('writers', 'WriterProfileController')->only([
//    'index', 'show'
//]);
Route::resource('writers', 'WriterProfileController')->parameters([
    'show' => 'id'
]);


// User
Route::post('writerUpdate/{id}', 'WriterProfileController@update');

// Asmin Verification
Route::get('/admin',  'Admin\Auth\LoginController@showLoginForm')->name('Admin');
Route::post('/loginAdmin', 'Admin\Auth\LoginController@login')->name('loginAdmin');


// User Verification
Route::get('/register', 'Web\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/registerUser', 'Web\Auth\RegisterController@register')->name('registerUser');
Route::get('email/verify', 'Web\Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Web\Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Web\Auth\VerificationController@resend')->name('verification.resend');

Route::get('/login', 'Web\Auth\LoginController@showLoginForm')->name('login');
Route::post('/loginUser', 'Web\Auth\LoginController@login')->name('loginUser');



// Writers Routes

include ('inc_files/writers.php');



// Admin Routes

include ('inc_files/admin.php');











//this website was made by Wainaina Nicholas Waruingi of Mombex Ent contact him through +254707722247 or email nickforbiz@gmail.com <a href="mombexent.com">Mombexent.com </a>