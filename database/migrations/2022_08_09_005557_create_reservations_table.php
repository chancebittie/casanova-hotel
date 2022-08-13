<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            // $table->string("nom");
            // $table->string("prenom");
            $table->string("type_reservation");
            $table->date("date_debut");
            $table->date("date_fin");
            $table->integer("duree_sejour");
            $table->integer("nombre_chambre");
            $table->integer("reduction");
            $table->integer("facture");
            $table->foreignId("chambre_id")->constrained();
            $table->foreignId("user_id")->constrained();
            $table->foreignId("client_id")->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
