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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->integer('facture_total');
            $table->integer('status_paiement')->default(0);
            $table->foreignId("chambre_id")->constrained();
            $table->foreignId("type_chambre_id")->constrained();
            $table->foreignId("user_id")->constrained();
            $table->foreignId("client_id")->constrained();
            $table->foreignId("reservation_id")->constrained();
            $table->foreignId("mode_paiement_id")->constrained()->nullable();
            $table->foreignId("restauration_id")->constrained();
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
        Schema::dropIfExists('paiements');
    }
};
