<?php

namespace App\Http\Livewire;

use App\Models\Chambre;
use App\Models\TypeChambre;
use Livewire\Component;

class Chambres extends Component
{
    public $status;
    public $numero;
    public $bloc;
    public $chambre_id;
    public $chambre_prix;
    public $chambre_type;
    public $type_chambre_id;
    public $editMode=false;

    public $rules=[
        "numero"=>"required|integer|unique:chambres|min:100|max:200",
        // "chambre_prix"=>"required|integer|min:10000|max:50000|unique:type_chambres",
    ];

    public function updated($propertedName){
        return $this->validateOnly($propertedName);
    }

    public function render()
    {
        return view('livewire.chambres',[
            "chambres"=>Chambre::all(),
            "typechambres"=>TypeChambre::all(),
            "type_chambres"=>TypeChambre::where('id', $this->type_chambre_id)->get(),
        ]);
    }

    public function goToAdd(){
        $this->editMode=false;
        $this->reset("type_chambre_id","numero","bloc");
        $type_chambres_first=TypeChambre::find(1);

        if (!empty($this->type_chambre_id)) {
            $this->type_chambre_id=$this->type_chambre_id;
        } else {
            $this->type_chambre_id=$type_chambres_first->id;
        }
        if (!empty($this->bloc)) {
            $this->bloc=$this->bloc;
        } else {
            $this->bloc=" Bloc A";
        }

        $this->dispatchBrowserEvent("showModalChambre");
    }

    public function ajouter(){
        $this->validate();

        Chambre::create([
            "numero"=>$this->numero,
            "bloc"=>$this->bloc,
            "status"=>0,
            "type_chambre_id"=>$this->type_chambre_id,
        ]);
        $this->reset("type_chambre_id","numero","bloc");
        $this->dispatchBrowserEvent("hideModalChambre");
    }


    public function goToEdit($tId,$id){
        $this->editMode=true;
        $chambre=Chambre::find($id);
        $chambre_t=TypeChambre::find($tId);
        $this->chambre_id=$chambre->id;
        $this->status=$chambre->status;
        $this->numero=$chambre->numero;
        $this->bloc=$chambre->bloc;
        $this->type_chambre_id=$tId;
        $this->chambre_prix=$chambre_t->chambre_prix;
        $this->dispatchBrowserEvent("showModalChambre");
    }

    public function modifier(){
        // $this->validate();
        $chambre=Chambre::find($this->chambre_id);
        $chambre->update([
            "numero"=>$this->numero,
            "bloc"=>$this->bloc,
            "status"=>$this->status,
            "type_chambre_id"=>$this->type_chambre_id,
        ]);
        $this->reset("type_chambre_id","numero","bloc");
        $this->dispatchBrowserEvent("hideModalChambre");
    }
}
