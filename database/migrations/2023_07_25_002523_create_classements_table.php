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
        Schema::create('classements', function (Blueprint $table) {
            $table->id();
            $table->foreignId("club_id")->constrained();
            $table->integer("pertandingan_dimainkan")->default(0);
            $table->integer("menang")->default(0);
            $table->integer("seri")->default(0);
            $table->integer("kalah")->default(0);
            $table->integer("gol_memasukkan")->default(0);
            $table->integer("gol_kemasukkan")->default(0);
            $table->integer("selisih_gol")->default(0);
            $table->integer("poin")->default(0);
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
        Schema::dropIfExists('classements');
    }
};
