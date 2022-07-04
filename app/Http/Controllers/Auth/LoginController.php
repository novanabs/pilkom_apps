<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth,Log;
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

    public function logout(){
    
        Log::info('Logout oleh - '.\Auth::user()->name);
        session()->flush();

        Auth::logout();

        return redirect()->route('login');
    }


    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        
        //TAMPUNG INFORMASI LOGINNYA
        $login = [
            'email' => $request->email,
            'password' => $request->password
        ];
        
        //LAKUKAN LOGIN
        if (Auth::attempt($login)) {

            Log::info('Login oleh - '.\Auth::user()->name);
            //JIKA BERHASIL, MAKA REDIRECT KE HALAMAN HOME

            // if(\Auth::user()->job_title_id != "Dosen Non Homebase"){
            //     return redirect()->route('home');
            // }else{
            //     return redirect()->route('app_krs_consultation.index');
            // }
            
            
        }
    
        //JIKA SALAH, MAKA KEMBALI KE LOGIN DAN TAMPILKAN NOTIFIKASI 
        return redirect()->route('login')->withErrors(['msg' => 'Email atau Password salah, mohon coba lagi!']);
    }
}