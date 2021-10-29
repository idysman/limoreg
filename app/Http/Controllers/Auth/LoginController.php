<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /***
     * 
     * Custom error message
     */

    private $errMessage =  'Invalid login credentials';

    /**
     * Get the login username to be used by the controller.
     *
     * 
     * @return string
     */
    
    protected function validateLogin(Request $request)
    {
        $data = $request->only($this->username(), 'password');

        $validator =  Validator::make($data, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
             return back()->withErrors($validator)->withInput();
        }
   }

   /**
    * Overload credentials functions
    */

   protected function credentials(Request $request)
   {
    
    if(is_numeric($request->username)){
        return ["phone"=> $request->username, "password"=> $request->password, "status"=> 1];
    }
    // username passed In email
    return ["email" => $request->username, 'password'=> $request->password, "status"=> 1];
   
   }

    public function username(){
      return 'username';
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



}
