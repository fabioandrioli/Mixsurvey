<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\LoginResquest;
use GuzzleHttp\Client;

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
    protected $redirectTo = RouteServiceProvider::DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

     public function showLoginForm(){
         return view('site.user_guest.login');
     }

      public function login(LoginResquest $request){
        $tokenCaptcha = $request->input('g-recaptcha-response');

        if($tokenCaptcha){
            $client = New Client();
            $response = $client->post('https://www.google.com/recaptcha/api/siteverify',[
                'form_params' => array(
                    'secret'    => '6LfmDqUZAAAAAJ6RNLstDrcC9p2-41_hDrRao-dS',
                    'response'  => $tokenCaptcha,
                )
            ]);

            $result = json_decode($response->getBody()->getContents());
            if($result){
                if($request->input('remember') == 1)
                    $remember = true;
                else
                    $remember = false;
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password],$remember)){
                    return redirect()->intended('guest');
                }
            }
        }
            return view('site.user_guest.login');
     }


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
