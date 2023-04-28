<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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

        DB::unprepared('
        CREATE TRIGGER medicament_created AFTER INSERT ON medicaments
        FOR EACH ROW
        BEGIN
            SET @denomination = NEW.denomination;
            SET @forme = NEW.forme;
            INSERT INTO medicament_triggers(denomination, forme) VALUES (@denomination, @forme);
        END
    ');
        DB::unprepared('
        CREATE TRIGGER medicament_update AFTER UPDATE ON medicaments
        FOR EACH ROW
        BEGIN
            SET @denomination = NEW.denomination;
            SET @forme = NEW.forme;
            INSERT INTO medicament_triggers(denomination, forme) VALUES (@denomination, @forme);
        END
    ');
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
