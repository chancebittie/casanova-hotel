<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Register extends Component
{

    public $name;
    public $pseudo;
    public $password;
    public $password_confirmation;

    protected $rules=[
        "name"=>"required|string|min:3",
        "pseudo"=>"required|string|min:3|unique:users",
        "password"=>"required|min:4",
        "password_confirmation"=>"required|min:4",
    ];

    public function updated($propertedNane){
        return $this->validateOnly($propertedNane);
    }

    public function render()
    {
        return view('livewire.register');
    }
}
