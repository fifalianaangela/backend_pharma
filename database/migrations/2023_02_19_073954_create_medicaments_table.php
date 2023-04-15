<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicaments', function (Blueprint $table) {
            $table->id();
            $table->string('denomination');
            $table->string('forme');
            $table->string('presentation');
            $table->float('coutUnitaire');
            $table->float('prixVente');
            $table->integer('nombreParBoite');
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
        Schema::dropIfExists('medicaments');
    }
}
