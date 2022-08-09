<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Users extends Component
{
    public $name;
    public $pseudo;
    public $password;
    public $role;
    public $user_id;
    public $editMode=false;

    public $rules=[
        "name"=>"required|string|min:3|max:30",
        "pseudo"=>"required|string|min:3|max:30|unique:users",
        // "password"=>"required|min:4|max:20",
    ];

    public function updated($propertedName){
        return $this->validateOnly($propertedName);
    }

    public function render()
    {
        return view('livewire.users',[
            "users"=>User::all(),
        ]);
    }

    public function goToAdd(){
        $this->editMode=false;
        $this->reset("name","pseudo","role");
        $this->dispatchBrowserEvent("showModal");
    }
    public function ajouter(){
        $this->validate();

        User::create([
            "name"=>$this->name,
            "pseudo"=>$this->pseudo,
            "isAdmin"=>$this->role,
            "password"=>Hash::make(1234),
        ]);
        $this->reset("name","pseudo","role");
        $this->dispatchBrowserEvent("hideModal");
    }


    public function goToEdit($id){
        $this->editMode=true;
        $user=User::find($id);
        $this->user_id=$user->id;
        $this->name=$user->name;
        $this->pseudo=$user->pseudo;
        $this->role=$user->isAdmin;
        // $this->reset("name","pseudo","role");
        $this->dispatchBrowserEvent("showModal");
    }

    public function modifier(){
        // $this->validate();
        $user=User::find($this->user_id);
        $user->update([
            "name"=>$this->name,
            "pseudo"=>$this->pseudo,
            "isAdmin"=>$this->role,
            // "password"=>Hash::make(1234),
        ]);
        $this->reset("name","pseudo","role");
        $this->dispatchBrowserEvent("hideModal");
    }

}
