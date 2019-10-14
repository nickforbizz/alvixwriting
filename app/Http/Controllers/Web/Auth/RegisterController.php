<?php

namespace App\Http\Controllers\Web\Auth;

use App\Models\Role;
use App\Models\User;
use App\Models\Writer;
use Illuminate\Http\Request;
use App\Models\WriterMediaProfile;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'login';
    use RegistersUsers;

    public function showRegistrationForm()
    {
        return view('Web.auth.register');
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    //Handles registration request for user
    /**
     * @param Request $request
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {

       try {
           DB::beginTransaction();


           $validate = Validator::make($request->all(), [
               'fname' => 'required|string|max:255',
               'lname' => 'required|string|max:255',
               'email' => 'required|string|email|max:255|unique:users',
               'password' => 'required|string|confirmed',
               'mobile' => 'required',
               'national_id' => 'required',
               'username'=> 'required'
           ]);

           if ($validate->fails()) {
               $errors = ([
                   'code'=> -1,
                   'errs'=>$validate->errors()
               ]);
               return back()->with([
                'errors' => $errors
            ]);
            //    return $errors;
           }

           $user =  Writer::create([
               'fname' => $request->fname,
               'lname' => $request->lname,
               'sname' => $request->sname,
               'email' => $request->email,
               'username' => $request->username,
               'password' => Hash::make($request->password),
               'national_id' => $request->national_id,
               'gender' => $request->gender,
               'age' => $request->age,
               'mobile' => $request->mobile,
               'address' => $request->address,
               'roles' => 'guest',
           ]);


//           $user = $this->createUser($request->all());
        //    $user = Auth::user();
           //Authenticates user
//           $this->guard()->login($user);

           if($user){

            WriterMediaProfile::create([
                'user_id' => $user->id,
                'name' => 'default.png',
                'media_link' => 'public/writerProfileImg/default.png',
                'type' => 'png'
            ]);

            DB::commit();

            return redirect()->route($this->redirectTo);

           }else{

               return back()->with([
                   'errors' => 'Error occured while saving the data to the db'
               ]);
           }



       } catch (\Exeption $e) {


           DB::rollback();
           report($e);
           return back()->with([
               'errors' => $e->getMessage()
           ]);

        //    return [
        //        'code'=>'-1',
        //        'message'=>$e->getMessage()
        //    ];
       }
        // return $request;
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function createUser(array $data)
    {
        $user =  User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'sname' => $data['sname'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'national_id' => $data['national_id'],
            'gender' => $data['gender'],
            'age' => $data['age'],
            'mobile' => $data['mobile'],
            'address' => $data['address'],
            'roles' => 'guest',
        ]);
        // $user
        //     ->roles()
        //     ->attach(Role::where('username', 'user')->first());
     return $user;
    }
    //Get the guard to authenticate user
   protected function guard()
   {
       return Auth::guard('admin');
   }
}
