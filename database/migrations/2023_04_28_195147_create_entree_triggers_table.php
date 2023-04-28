<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntreeTriggersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entree_triggers', function (Blueprint $table) {
            $table->id();
            $table->datetime('dateEntree');
            $table->integer('quantiteEntree');
            $table->timestamps();
        });

        DB::unprepared('
        CREATE TRIGGER entree_created AFTER INSERT ON entrees
        FOR EACH ROW
        BEGIN
            SET @dateEntree = NEW.dateEntree;
            SET @quantiteEntree = NEW.quantiteEntree;
            INSERT INTO entree_triggers(dateEntree, quantiteEntree) VALUES (@dateEntree, @quantiteEntree);
        END
    ');
    DB::unprepared('
        CREATE TRIGGER entree_update AFTER UPDATE ON entrees
        FOR EACH ROW
        BEGIN
            SET @dateEntree = NEW.dateEntree;
            SET @quantiteEntree = NEW.quantiteEntree;
            INSERT INTO entree_triggers(dateEntree, quantiteEntree) VALUES (@dateEntree, @quantiteEntree);
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
        Schema::dropIfExists('entree_triggers');
    }
}
