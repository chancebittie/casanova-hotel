<?php

namespace App\Http\Livewire;

use App\Models\Chambre;
use App\Models\Paiement;
use App\Models\Reservation;
use App\Models\TypeChambre;
use Carbon\Carbon;
use Livewire\Component;

class ListeReservations extends Component
{
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
    public $reservation_id;
    public $editMode=false;
    public $personneMode=true;
    public $recu;
    public $facture;
    public $search;
    public $last_id;
    public $day1;
    public $day2;
    public $cal;

    protected $listeners=['comfirmationSucess','deleteSucess'];

    public function updated(){
        // if (!empty($this->chambre_id) and !empty($this->nombre_chambre) and !empty($this->duree_sejour)) {
        //     $this->facture=$this->nombre_chambre * $this->duree_sejour * $this->chambre_prix;
        // }
        // // $this->facture=$reservation->facture;
        // if (!empty($this->date_debut) and !empty($this->date_fin)) {
        //     $this->duree_sejour = round(($this->day2 - $this->day1) / 3600 /24);
        // }
        $type_chambre_first=TypeChambre::find($this->type_chambre_id);
        // if (!empty($this->type_chambre_id) ) {
            $this->chambre_prix =$type_chambre_first->chambre_prix ;
        // }
        $this->day1 = strtotime($this->date_debut);   //date de debut
        $this->day2 = strtotime($this->date_fin);     //date de fin
        // $this->cal=$this->facture ;
    }

    public function render()
    {
        // Carbon::setLocale(LC_TIME,['fr','fra','fr_FR']);
        // setlocale(LC_TIME,['fr','fra','fr_FR']);
        // $this->day1 = strtotime($this->date_debut);   //date de debut
        // $this->day2 = strtotime($this->date_fin);

        return view('livewire.liste-reservations',[
            "reservations"=>Reservation::all(),
            "typechambres"=>TypeChambre::all(),
            // "clien"=>Client::latest("id")->first(),
            // "clients"=>$clientQuery->get(),
            "chambre_libres"=>Chambre::where("type_chambre_id",$this->type_chambre_id)->where("chambre_status",false)->get(),

        ]);
    }

    public function goToEdit($id){
        $reservation=Reservation::find($id);
        $this->nom=$reservation->client->nom;
        $this->prenom=$reservation->client->prenom;
        $this->email=$reservation->client->email;
        $this->nationalite=$reservation->client->nationalite;
        $this->type_reservation=$reservation->type_reservation;
        $this->date_debut=$reservation->date_debut;
        $this->date_fin=$reservation->date_fin;
        $this->duree_sejour=$reservation->duree_sejour;
        $this->nombre_chambre=$reservation->nombre_chambre;
        $this->facture=$reservation->facture;
        $this->type_chambre_id=$reservation->type_chambre_id;
        $this->chambre_id=$reservation->chambre_id;
        $this->client_id=$reservation->client_id;
        $this->caissier=$reservation->user->name;
        $this->cal=$this->facture +  $this->nombre_chambre ;
        // $this->duree_sejour = round(($this->day2 - $this->day1) / 3600 /24);
        // $this->facture=$this->nombre_chambre * $this->duree_sejour * $this->chambre_prix;
        $this->dispatchBrowserEvent("showModalReservation");
    }

    public function goToConfirm($id){
        $reservation=Reservation::find($id);
        $this->reservation_id=$reservation->id;
        $this->facture_total=$reservation->facture;
        // $this->facture=$reservation->facture;
        $this->type_chambre_id=$reservation->type_chambre_id;
        $this->chambre_id=$reservation->chambre_id;
        $this->client_id=$reservation->client_id;
        $this->caissier=$reservation->user->id;
        $this->dispatchBrowserEvent("comfirmation");
    }
    public function comfirmationSucess(){
        $reservation=Reservation::find($this->reservation_id);
        $reservation->update([
            "type_reservation"=>1,
        ]);

        $chambre=Chambre::find($this->chambre_id);
        $chambre->update([
                "chambre_status"=>1,
            ]);

        Paiement::create([
            "chambre_id"=>$this->chambre_id,
            "type_chambre_id"=>$this->type_chambre_id,
            "reservation_id"=>$this->reservation_id,
            "client_id"=>$this->client_id,
            "user_id"=>$this->caissier,
            // "mode_paiement_id"=>$this->mode_paiement_id,
            "facture_total"=>$this->facture_total,
            // "chambre_id"=>$this->,
            // "chambre_id"=>$this->,
        ]);


        $this->dispatchBrowserEvent("comfirmationS");
    }

    public function goToDelete($id){
        $reservation=Reservation::find($id);
        $this->reservation_id=$reservation->id;
        // $this->nom=$reservation->nom;
        // $this->prenom=$reservation->prenom;
        $this->dispatchBrowserEvent("delete");
    }
    public function deleteSucess(){
        $reservation=Reservation::find($this->reservation_id);
        $reservation->delete();
        $this->dispatchBrowserEvent("deleteS");
    }
}
