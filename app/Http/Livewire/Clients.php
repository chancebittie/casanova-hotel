<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Carbon\Carbon;
use Livewire\Component;

class Clients extends Component
{
    public $nom;
    public $prenom;
    public $email;
    public $nationalite;
    public $search="";
    // public $chambre_type;
    public $client_id;
    public $editMode=false;

    public $rules=[
        "nom"=>"required|string|min:3|max:200",
        "prenom"=>"required|string|min:3|max:200",
        "email"=>"email|unique:clients|max:200",
        // "chambre_prix"=>"required|integer|min:10000|max:50000|unique:type_chambres",
    ];

    public function updated($propertedName){
        return $this->validateOnly($propertedName);
    }
    public function render()
    {
        // Carbon::setLocale('fr');
        $clientQuery=Client::query();
        if ($this->search != "") {
            $clientQuery->where("nom", "LIKE","%".$this->search."%")
                            ->orWhere("prenom", "LIKE","%".$this->search."%");
        }
        return view('livewire.clients',[
            "clients"=>$clientQuery->get(),
        ]);
    }

    public function goToAdd(){
        $this->editMode=false;
        $this->reset("nom","prenom","email","nationalite");
        if (!empty($this->nationalite)) {
            $this->nationalite=$this->nationalite;
        } else {
            $this->nationalite=1;
        }
        $this->dispatchBrowserEvent("showModalClient");
    }

    public function ajouter(){
        $this->validate();

        Client::create([
            "nom"=>$this->nom,
            "prenom"=>$this->prenom,
            "email"=>$this->email,
            "nationalite"=>$this->nationalite,
        ]);
        $this->reset("nom","prenom","email","nationalite");
        $this->dispatchBrowserEvent("hideModalClient");
    }


    public function goToEdit($id){
        $this->editMode=true;
        $client=Client::find($id);
        // $chambre_t=TypeChambre::find($tId);
        $this->client_id=$client->id;
        $this->nom=$client->nom;
        $this->prenom=$client->prenom;
        $this->email=$client->email;
        $this->nationalite=$client->nationalite;
        // $this->chambre_prix=$chambre_t->chambre_prix;
        $this->dispatchBrowserEvent("showModalClient");
    }

    public function modifier(){
        $client=Client::find($this->client_id);
        $client->update([
            "nom"=>$this->nom,
            "prenom"=>$this->prenom,
            "email"=>$this->email,
            "nationalite"=>$this->nationalite,
        ]);
        $this->reset("nom","prenom","email","nationalite");
        $this->dispatchBrowserEvent("hideModalClient");
    }
}
