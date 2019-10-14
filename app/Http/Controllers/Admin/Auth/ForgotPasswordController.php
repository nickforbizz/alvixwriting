<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails; 
  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function showLinkRequestForm()
    {
        return view('Admin.auth.passwords.email');
    }

    
    public function showResetForm(Request $request, $token)
    {
        
        return view('Admin.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    } 
    
    
    public function broker()
    {
        return Password::broker('admins');
    }

    protected function guard()
    {
      return Auth::guard('admin');
    }
   


}
