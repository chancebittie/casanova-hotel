<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\Paiement;
use Livewire\Component;
use App\Models\Reservation;
use App\Models\RestaurantBar;
use App\Models\TypeChambre;

class Paiements extends Component
{
    public $fact;
    // public $paie;

    public function render()
    {
        // $restaurantBar=RestaurantBar::where("paiement_id",$paie->id)->get();

        return view('livewire.paiements',[
            "paiements"=>Paiement::orderBy('id','DESC')->get(),
            "reservations"=>Reservation::all(),
            "typechambres"=>TypeChambre::all(),
            // "restaurantBar"=>RestaurantBar::where("paiement_id",$this->paiement->id)->sum('montant_total'),
            // "restaurantBar"=>RestaurantBar::where("paiement_id",$paie->id)->sum('montant_total'),
            // "clien"=>Client::latest("id")->first(),
            "clients"=>Client::all(),
            // "chambre_libres"=>Chambre::where("type_chambre_id",$this->type_chambre_id)->where("chambre_status",false)->get(),
        ]);
    }
}
