<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        "nom",
        "prenom",
        "email",
        "nationalite",
];

 // un client peut faire plusieur reservation
 public function reservations(){
    return $this->hasMany(Reservation::class);

}

}
