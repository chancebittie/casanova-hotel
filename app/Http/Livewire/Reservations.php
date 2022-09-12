<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Client;
use App\Models\Chambre;
use Livewire\Component;
use App\Models\Paiement;
use App\Models\Reservation;
use App\Models\TypeChambre;
use Illuminate\Support\Facades\Auth;

class Reservations extends Component
{

    // public $clientss;
    public $nom;
    public $prenom;
    public $email;
    public $nationalite=1;
    public $date_debut;
    public $date_fin;
    public $duree_sejour;
    public $nombre_chambre;
    public $reduction;
    public $chambre_id;
    public $chambre_prix;
    public $type_chambre_id;
    public $type_reservation=1;
    public $mode_reservation="personne";
    public $user_id;
    public $client_id;
    public $editMode=false;
    public $personneMode=true;
    public $recu;
    public $day1;
    public $day2;
    public $facture;
    public $search;
    public $last_id;
    public $reservation_last_id;

    public $rules=[
        "nom"=>"required|string|min:3|max:200",
        "prenom"=>"required|string|min:3|max:200",
        "chambre_id"=>"required",
        // "nationalite"=>"required|integer",
        // "date_debut"=>"required|date",
        // "date_fin"=>"required|date",
        // "duree_sejour"=>"required|integer",
        // "nombre_chambre"=>"required|integer",
        // "reduction"=>"integer|min:0",
    ];

    public function updated($propertedName){
        $type_chambre_first=TypeChambre::find($this->type_chambre_id);
        // if (!empty($this->type_chambre_id) ) {
            $this->chambre_prix =$type_chambre_first->chambre_prix ;
        // }

        if (!empty($this->client_id)) {
            $client_first=Client::find($this->client_id);
            // $this->nom="nom";
            $this->nom=$client_first->nom;
            $this->prenom=$client_first->prenom;
            $this->email=$client_first->email;
            $this->nationalite=$client_first->nationalite;
        }

        $this->day1 = strtotime($this->date_debut);   //date de debut
        $this->day2 = strtotime($this->date_fin);     //date de fin
//   round ces pour arrondir
//   jd-ja / 1 ans / jour
        // $this->reçu=date('dmYHi');

        // if (empty($this->reduction)) {
        //     $this->reduction=0;
        //     // $this->chambre_id= $nombre_chambre_first->chambre_numero;
        // }
        if (!empty($this->date_debut) and !empty($this->date_fin)) {
            $this->duree_sejour = round(($this->day2 - $this->day1) / 3600 /24);
        }

        if (!empty($this->chambre_id) and !empty($this->nombre_chambre) and !empty($this->duree_sejour)) {
            // if (!empty($this->reduction)) {
                // if ($this->duree_sejour < ) {

                    $this->facture=$this->nombre_chambre * $this->duree_sejour * $this->chambre_prix;

                // } else {
                //     $this->facture="erreur au  niveau de la date";
                // }
            // } else {
            //     $this->facture=$this->nombre_chambre * $this->duree_sejour * $this->chambre_prix ;
            // }
        }

        if (empty($this->nombre_chambre)) {
            $this->nombre_chambre=1;
            // $this->chambre_id= $nombre_chambre_first->chambre_numero;
        }
        if ($this->mode_reservation=="personne") {
            $this->personneMode=true;

        }else {
            $this->personneMode=false;
        }




        return $this->validateOnly($propertedName);
    }


    public function render()
    {

        // if ($this->type_chambre_id= 3 and empty($this->chambre_id) ) {
        //     $this->chambre_id=3;
        // }
        // if ($this->type_chambre_id= 2 and empty($this->chambre_id) ) {
        //     $this->chambre_id=2;
        // }

        // if ($this->type_chambre_id= 1 and empty($this->chambre_id) ) {
        //     $this->chambre_id=1;
        // }
        if (empty($this->type_chambre_id)) {
            $this->type_chambre_id=1;
        }
        // if (empty($this->type_reservation)) {
        //     $this->type_reservation=1;
        // }
        // if (empty($this->chambre_id)) {
        //     $chambre_id_first=Chambre::find(1);
        //     $this->chambre_id= $chambre_id_first->chambre_numero;
        // }
        // Carbon::setLocale('fr');
        $clientQuery=Client::query();
        if ($this->search != "") {
            $clientQuery->where("nom", "LIKE","%".$this->search."%")
                            ->orWhere("prenom", "LIKE","%".$this->search."%");
        }
        $clien=Client::latest("id")->first();
        $this->last_id=$clien->id + 1;
        $reservation_last=Reservation::latest("id")->first();
        $this->reservation_last_id=$reservation_last->id + 1;

        return view('livewire.reservation',[
            "reservations"=>Reservation::all(),
            "typechambres"=>TypeChambre::all(),
            // "clien"=>Client::latest("id")->first(),
            "clients"=>$clientQuery->get(),
            "chambre_libres"=>Chambre::where("type_chambre_id",$this->type_chambre_id)->where("chambre_status",false)->get(),
        ]);
    }


    public function goToAdd(){
        // $this->editMode=false;
        // $this->reset("nom","prenom","email","nationalite","date_debut","date_fin","duree_sejour","nombre_chambre","chambre_id","facture","reduction");
        // $type_chambres_first=Reservation::find(1);

        // if (!empty($this->type_chambre_id)) {
        //     $this->type_chambre_id=$this->type_chambre_id;
        // } else {
        //     $this->type_chambre_id=$type_chambres_first->id;
        // }
        // if (!empty($this->bloc)) {
        //     $this->bloc=$this->bloc;
        // } else {
        //     $this->bloc=" Bloc A";
        // }

        $this->dispatchBrowserEvent("showModalChambre");
    }

    public function reservation(){
        $this->validate();

        if (empty($this->client_id)) {
            Client::create([
                "nom"=>$this->nom,
                "prenom"=>$this->prenom,
                "email"=>$this->email,
                "nationalite"=>$this->nationalite,
            ]);

            $this->client_id=$this->last_id;
        }


        Reservation::create([
            "type_reservation"=>$this->type_reservation,
            "date_debut"=>$this->date_debut,
            "date_fin"=>$this->date_fin,
            "duree_sejour"=>$this->duree_sejour,
            "nombre_chambre"=>$this->nombre_chambre,
            "facture"=>$this->facture,
            "type_chambre_id"=>$this->type_chambre_id,
            "chambre_id"=>$this->chambre_id,
            "user_id"=>Auth::user()->id,
            "client_id"=>$this->client_id,
        ]);

        if ($this->type_reservation) {
            Paiement::create([
                "chambre_id"=>$this->chambre_id,
                "type_chambre_id"=>$this->type_chambre_id,
                "reservation_id"=>$this->reservation_last_id,
                "client_id"=>$this->client_id,
                "user_id"=>Auth::user()->id,
                // "mode_paiement_id"=>$this->mode_paiement_id,
                "facture_total"=>$this->facture,
                // "chambre_id"=>$this->,
                // "chambre_id"=>$this->,
            ]);

            $chambre=Chambre::find($this->chambre_id);
            $chambre->update([
                "chambre_status"=>1,
            ]);
        }
        $this->reset("nom","prenom","email","nationalite","date_debut","date_fin","duree_sejour","nombre_chambre","chambre_id","facture","reduction");
        $this->dispatchBrowserEvent("hideModalChambre");
    }


    public function goToEdit($tId,$id){
        $this->editMode=true;
        $reservation=Reservation::find($id);
        // $chambre_t=TypeChambre::find($tId);
        $this->chambre_id=$reservation->id;
        $this->status=$reservation->status;
        $this->numero=$reservation->numero;
        $this->bloc=$reservation->bloc;
        $this->type_chambre_id=$tId;
        // $this->chambre_prix=$chambre_t->chambre_prix;
        $this->dispatchBrowserEvent("showModalChambre");
    }

    public function modifier(){
        // $this->validate();
        $reservation=Reservation::find($this->chambre_id);
        $reservation->update([
            "numero"=>$this->numero,
            "bloc"=>$this->bloc,
            "status"=>$this->status,
            "type_chambre_id"=>$this->type_chambre_id,
        ]);
        $this->reset("nom","prenom","email","nationalite","date_debut","date_fin","duree_sejour","nombre_chambre","chambre_id","facture","reduction");
        $this->dispatchBrowserEvent("hideModalChambre");
    }
}
