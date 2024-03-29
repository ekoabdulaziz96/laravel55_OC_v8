<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

use App\User;
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
        $this->middleware('guest')->except('logout','logoutUser');
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [           
            $this->username() => ['required','string',
            Rule::exists('users')->where(function($query){
                $query->where('active',true);
            })
        ],
            'password' => 'required|string',
        ],[
            $this->username().'.exists'=>'the selected email invalid or you need to active your account'
        ]);
    }

    //     public function logoutUser()
    // {
    //     Auth::guard('web')->logout();
    //     return redirect('/');
    // }
        protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        $user=User::where('email',$request->email)->first();
       if ($user->status =='super_admin'){
        return   redirect()->route('admin') ;
       }else {
        return ('home');
       }
      
    }


}
