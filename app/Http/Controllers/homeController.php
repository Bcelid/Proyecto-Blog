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
    public function login()
    {
        $credential = request()->only('email', 'password');
        // Consultamos si las credenciales están correctas
        if (Auth::attempt($credential)) {
            // Para evitar la vulnerabilidad session fixation
            request()->session()->regenerate();
            // Una vez abierta la sesión, redirigimos al usuario con datos adicionales
            return redirect('home');
        } else {
            // En caso de ser incorrectas, redirigimos al inicio con un mensaje de error
            return redirect('/')->with('error', 'Credenciales incorrectas. Inténtelo de nuevo.');
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
