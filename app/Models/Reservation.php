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
            "type_chambre_id",
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
    // la reservation appartien a un seul client
    public function client(){
        return $this->belongsTo(Client::class);

    }
    // la reservation appartien a un seul caissier
    public function user(){
        return $this->belongsTo(User::class);

    }
    // la reservation appartien a une seule chambre
    public function chambre(){
        return $this->belongsTo(Chambre::class);

    }
    // la reservation appartient a un seul type de chambre
    public function typeChambre(){
        return $this->belongsTo(TypeChambre::class);

    }
}
