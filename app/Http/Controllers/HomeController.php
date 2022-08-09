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
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function utilisateurs()
    {
        return view('admin.utilisateurs');
    }
    public function chambres()
    {
        return view('admin.chambres');
    }
    public function typechambres()
    {
        return view('admin.typechambres');
    }
}
