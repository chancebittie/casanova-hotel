<?php

namespace App\Http\Livewire;

// use App\Models\restaurant_bar;
// use App\Models\RestaurantBar as ModelsRestaurantBar;

use App\Models\Client;
use App\Models\Paiement;
use App\Models\Reservation;
use Livewire\Component;
use App\Models\RestaurantBar as ModelsRestaurantBar;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

class RestaurantBar extends Component
{

    public $type_client=1;
    public $type_dejeuner='Petit déjeuner';
    public $numero_table=1;
    public $quantite=1;
    public $nombre_couvert=1;
    // public $bar_restau;
    public $type_facture="Restau";
    public $caissier;
    public $bar=0;
    public $cave=0;
    public $montant_total;
    public $comptant;
    public $credit=0;
    public $offert=0;
    public $paiement_id;
    public $paiement_facture_total;
    public $client_id;
    public $client_nom;
    public $observation;
    public $prix_unitaire;
    public $numero_facture;
    public $last_restaurantBarId;

    protected $rules=[
        // "nombre_table"=>"required|min:1|integer",
        "quantite"=>"required|min:1|integer",
        "nombre_couvert"=>"required|min:1|integer",
        "client_nom"=>"required|",
        // "dejeuner"=>"required|",
        // "diner"=>"required|",
        // "bar"=>"required|",
        "prix_unitaire"=>"required|integer|min:200",
        // "montant_total"=>"required|",
        // "comptant"=>"required|",
        "credit"=>"required|",
        "offert"=>"required|",
        "paiement_id"=>"required|",
        // "observation"=>"string",
        // "numero_facture"=>"required|",
    ];

    public function updated($propertedName){

        if (empty($this->quantite) ) {
            $this->bar=0;
        }
        if (empty($this->cave) ) {
            $this->cave=0;
        }
        // if (errors()) {
        //     # code...
        // } else {
        //     # code...
        // }



        return $this->validateOnly($propertedName);
    }

    public function render()
    {
        if (is_numeric($this->prix_unitaire)) {
            $this->montant_total=$this->quantite * $this->prix_unitaire;
        }
        // selectionne le dernier paiment du client
        $paiementId=Paiement::where("client_id", $this->client_id)->latest()->first();
        // si l'id du client et son paiement son pas vide alors alors le paiement id egale a sont id sinon ces null
        if (!empty($this->client_id) and !empty($paiementId->id)) {
                $this->paiement_id=$paiementId->id;
                $this->paiement_facture_total=$paiementId->facture_total;

        }else {
            $this->paiement_id=Null;
            $this->paiement_facture_total=Null;
        }

        // $clientQuery=Client::query();
        // if ($this->search != "") {
        //     $clientQuery->where("nom", "LIKE","%".$this->search."%")
        //                     ->orWhere("prenom", "LIKE","%".$this->search."%");
        // }

        // compte le nombre de colonne de restaurant bar et ajoute 1 dessus
            $this->last_restaurantBarId=count(ModelsRestaurantBar::all()) + 1;


        return view('livewire.restaurant-bar',[
            "restaurantBars"=>ModelsRestaurantBar::all(),
            "clients"=>Client::all(),
            // "clients"=>Paiement::where(""),
        ]);
    }

    public function goToAdd(){
        $this->dispatchBrowserEvent("showModalRestaurant");
    }

    public function submit(){

        // si ces un client de l'hotel et que l'id es vide alors mets 1 sion mets son identifiant sinon null
        if ($this->type_client) {
            if (empty($this->client_id)) {
                $this->client_id=1;
            } else {
                $this->client_id=$this->client_id;
            }

            // si la paiement existe alors la facture total egale au montant de restaurant + montan de reservation
           if ($this->paiement_id) {
                $facture=$this->montant_total + $this->paiement_facture_total;
                $paiement=Paiement::find($this->paiement_id);
                $paiement->update([
                    "facture_total"=>$facture ,
                ]);
           }

        } else {
            $this->client_id=Null;

        }

        // $this->validate();

        ModelsRestaurantBar::create([
            "numero_table"=>$this->numero_table,
            "quantite"=>$this->quantite,
            "prix_unitaire"=>$this->prix_unitaire,
            "nombre_couvert"=>$this->nombre_couvert,
            "type_facture"=>$this->type_facture,
            "comptant"=>$this->comptant,
            "credit"=>$this->credit,
            "offert"=>$this->offert,
            "type_dejeuner"=>$this->type_dejeuner,
            "paiement_id"=>$this->paiement_id,
            "user_id"=>Auth::user()->id,
            "client_id"=>$this->client_id,
            "client_nom"=>$this->client_nom,
            "observation"=>$this->observation,
            "numero_facture"=>$this->last_restaurantBarId,
            "montant_total"=>$this->montant_total,
        ]);

        // $client=Paiement::find()
        // ::update([
        //     ""
        // ])
        $this->dispatchBrowserEvent("hideModalRestaurant");
    }

    // au cas ou la personne es de passage il faut comfirmer quil a payer et tire recu
    public function comfirmer($id){
        $restaurant=ModelsRestaurantBar::find($id);
        $restaurant->update([
            "status_paiement"=>1,
        ]);
    }
}
