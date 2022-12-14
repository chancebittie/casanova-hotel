<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Reservation;
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
    public function clients()
    {
        return view('admin.clients');
    }
    public function reservations()
    {
        return view('admin.reservations');
    }
    public function restaurant_bar()
    {
        return view('admin.restaurant-bar');
    }
    public function paiements()
    {
        // $reservation=Reservation::find($id);
        return view('admin.paiements');
    }
    public function listeReservations()
    {
        return view('admin.liste_reservations');
    }
}
