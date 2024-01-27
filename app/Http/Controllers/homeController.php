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
    //Funcion para login, validamos los campos de email y password para autenticar
    public function login(){
        $credential = request()-> only('email','password');
        //Consultamos si las credenciales estan correctas
        if(Auth::attempt($credential)){
            //Para evitar la vulnerabilidad session fixation
            request()->session()->regenerate();
            //una vez abierta la session redirigimos al usuario
            return redirect('home');
        }else{
            //en caso de ser incorrectas redirigimos al inicio
            return redirect('index');
        }
    }    
    //funcion para cerrar sesion
    public function logout(Request $request){
        Auth::logout();
        //invalidamos el token y la session
        $request -> session()->invalidate();
        $request -> session() ->regenerateToken();
        //redirigimos
        return redirect('/');
    }
}
