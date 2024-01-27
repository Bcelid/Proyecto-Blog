<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class homeController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function login(){
        $credential = request()-> only('email','password');
        if(Auth::attempt($credential)){
            //Para evitar la vulnerabilidad session fixation
            request()->session()->regenerate();
            return redirect('home');
        }else{
            return redirect('index');
        }
    }    
    public function logout(Request $request){
        Auth::logout();
        $request -> session()->invalidate();
        $request -> session() ->regenerateToken();
        return redirect('/');
    }
}
