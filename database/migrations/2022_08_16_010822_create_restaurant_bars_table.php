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
        Schema::create('restaurant_bars', function (Blueprint $table) {
            $table->id();
            $table->string("nom")->nullable();
            $table->integer("numero_table");
            $table->integer("quantite");
            $table->integer("prix_unitaire");
            $table->integer("nombre_couvert");
            $table->integer("type_dejeuner");
            $table->integer("type_facture");
            // $table->integer("cave")->nullable();
            $table->integer("montant_total");
            $table->integer("comptant");
            $table->boolean("credit")->default("0");
            $table->boolean("offert")->default("0");
            $table->foreignId("paiement_id")->nullable()->constrained();
            $table->foreignId("client_id")->nullable()->constrained();
            $table->foreignId("user_id")->nullable()->constrained();
            $table->string("observation");
            $table->integer("numero_facture");
            $table->integer("status_paiement");
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
        Schema::dropIfExists('restaurant_bars');
    }
};
