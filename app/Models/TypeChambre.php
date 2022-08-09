<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeChambre extends Model
{
    use HasFactory;
    protected $fillable=[
        "chambre_type",
        "chambre_prix",
    ];

    public function chambres(){
        return $this->belongsTo(Chambre::class);
    }
}
