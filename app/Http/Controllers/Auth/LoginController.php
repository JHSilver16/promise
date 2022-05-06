<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

use Illuminate\Http\Request;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo(){
        
    // User role
    $role = Auth::user()->usertype_id; 
   
    // Check user role
    \Log::info($role);
        if(($role == 3) || ($role == 5) || ($role == 11)){
            return '/items';
        }
        else if($role == 4 || $role == 1 || $role == 2 || $role == 9 || $role == 10){
            return '/prsstaff';
        }
    }

    public function logout(Request $request) {
      $role = Auth::user()->usertype_id; 
       if($role == 2){
             Auth::logout();
            return redirect('/');
        }
        else{
             Auth::logout();
          return redirect('/login');
        }
     
    }
}
