<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantBar extends Model
{
    use HasFactory;

    protected $fillable=[
            "numero_table",
            "quantite",
            "prix_unitaire",
            "nombre_couvert",
            "type_dejeuner",
            "type_facture",
            "client_nom",
            "montant_total",
            "comptant",
            "credit",
            "offert",
            "paiement_id",
            "user_id",
            "client_id",
            "observation",
            "status_paiement",
            "numero_facture",
    ];
    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function paiements(){
        return $this->hasMany(Paiement::class);
    }
}
