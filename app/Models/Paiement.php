<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    protected $fillable=[
        "status_paiement",
        "mode_paiement_id",
        "reservation_id",
        "type_chambre_id",
        "facture_total",
        "chambre_id",
        "user_id",
        "client_id",
    ];

    public function chambre(){
        return $this->belongsTo(Chambre::class);
    }

    public function type_chambre(){
        return $this->belongsTo(TypeChambre::class);
    }
    public function reservation(){
        return $this->belongsTo(Reservation::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function restaurantBar(){
        return $this->hasMany(RestaurantBar::class);
    }

    // public function scopeOnline($query){
    //     // une requette qui retourne les status qui sont a 1
    //     return $query->where('chambre_status', 1);

    // }
}
