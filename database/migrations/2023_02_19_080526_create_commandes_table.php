<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreign('idMedicament')->references('id')->on('medicaments');
            $table->foreign('idFournisseur')->references('id')->on('fournisseurs');
            $table->integer('quantite');
            $table->dateTime('dateCommande');
            $table->dateTime('dateLivraison');
            $table->float('montantCommande');
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
        Schema::dropIfExists('commandes');
    }
}
