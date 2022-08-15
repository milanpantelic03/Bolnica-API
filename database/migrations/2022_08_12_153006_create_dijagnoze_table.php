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
        Schema::create('dijagnoze', function (Blueprint $table) {
            $table->id();
            $table->string("naziv_bolesti");
            $table->string("trenutna_terapija");
            $table->integer("broj_kartona");
            $table->string("stanje_pacijenta");

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
        Schema::dropIfExists('dijagnoze');
    }
};
