<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicamentTriggersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicament_triggers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('denomination');
            $table->string('forme');
            $table->string('type');
            $table->integer('userId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicament_triggers');
    }
}
