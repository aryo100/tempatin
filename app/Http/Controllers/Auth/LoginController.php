<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    
    public function login(Request $request)
    {
        $this->validateLogin($request);
    
        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();
            $user->generateToken();
            if(request()->segment(2)=='api'){
                return response()->json([
                        'error' => 'berhasil!!'
                    ]);
            }
            // if(Auth::user()->role_id==0){ //admin master
            //         $this->redirectTo = 'master/dashboard';
            //         return redirect($this->redirectTo);
            // }elseif(Auth::user()->role_id==1){ //admin merchant
            //         $this->redirectTo = 'merchant/dashboard';
            //         return redirect($this->redirectTo);
            // }
        }else{
            // return response()->json([
            //     'error' => 'Error!!'
            // ]);
            return redirect('login')->with('error', 'Username dan Password tidak sesuai.');
        }
    
        // return $this->sendFailedLoginResponse($request);
    }

    public function signin(Request $request)
    {
        $this->validateLogin($request);
    
        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();
            $user->generateToken();
            return response()->json([
                    'data'=> $user,
                    'error' => false
                ]);
        }else{
            return response()->json([
                'error' => true
            ]);
        }
    }
    
    public function logout()
    {
        $user = Auth::guard('api')->user();
    
        if ($user) {
            $user->remember_token = null;
            $user->save();
        }
    
        Auth::logout();
        $this->redirectTo = 'login';
        return redirect()->route('login');
    }

}
