<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
            "type_reservation",
            "date_debut",
            "date_fin",
            "duree_sejour",
            "nombre_chambre",
            // "reduction",
            "facture",
            "chambre_id",
            "user_id",
            "client_id",
    ];

    public function scopeOnline($query){
        // une requette qui retourne les status qui sont a 1
        return $query->where('chambre_status', 1);

    }
     public function scopeOffline($query){
        // une requette qui retourne les status qui sont a 1
        return $query->where('chambre_status', 0);

    }
}
