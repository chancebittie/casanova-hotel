<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chambre extends Model
{
    use HasFactory;

    protected $fillable=[
        "numero",
        "bloc",
        "type_chambre_id",
        // "",
    ];


    public function type_chambre(){
        return $this->belongsTo(TypeChambre::class);
    }
}
