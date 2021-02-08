<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()//funzione constructor che crea l'istanza di un oggetto
    {
        $this->middleware('auth');//controllo di una sezione valida nel cookie
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
        //output in caso di successo del contorllo
    }
}
