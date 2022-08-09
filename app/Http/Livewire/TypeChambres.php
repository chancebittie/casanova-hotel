<?php

namespace App\Http\Livewire;

use App\Models\TypeChambre ;
use Livewire\Component;

class TypeChambres extends Component
{
    public $chambre_type;
    public $chambre_prix;
    public $chambre_id;
    public $editMode=false;

    public $rules=[
        "chambre_type"=>"required|string|unique:type_chambres|min:3|max:30",
        "chambre_prix"=>"required|integer|min:10000|max:50000|unique:type_chambres",
    ];

    public function updated($propertedName){
        return $this->validateOnly($propertedName);
    }

    public function render()
    {
        return view('livewire.type-chambre',[
            "typechambres"=>TypeChambre::all(),
        ]);
    }

    public function goToAdd(){
        $this->editMode=false;
        $this->reset("chambre_type","chambre_prix");
        $this->dispatchBrowserEvent("showModalTypeChambre");
    }
    public function ajouter(){
        $this->validate();

        TypeChambre::create([
            "chambre_type"=>$this->chambre_type,
            "chambre_prix"=>$this->chambre_prix,
        ]);
        $this->reset("chambre_type","chambre_prix");
        $this->dispatchBrowserEvent("hideModalTypeChambre");
    }


    public function goToEdit($id){
        $this->editMode=true;
        $typechambre=TypeChambre::find($id);
        $this->chambre_id=$typechambre->id;
        $this->chambre_type=$typechambre->chambre_type;
        $this->chambre_prix=$typechambre->chambre_prix;
        $this->dispatchBrowserEvent("showModalTypeChambre");
    }

    public function modifier(){
        // $this->validate();
        $typechambre=TypeChambre::find($this->chambre_id);
        $typechambre->update([
            "chambre_type"=>$this->chambre_type,
            "chambre_prix"=>$this->chambre_prix,
        ]);
        $this->reset("chambre_type","chambre_prix");
        $this->dispatchBrowserEvent("hideModalTypeChambre");
    }
}
