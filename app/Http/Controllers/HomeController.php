<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['verificar']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function verificar(Request $request){
        //dd('hola');
        if(Auth::attempt(['usuario'=>$request->usuario,'password'=>$request->password])){
            return view('welcome');

        }else{
            return "No ingresaste";
        }
    }
}
