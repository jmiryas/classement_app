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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->unique(["first_club_id", "second_club_id"]);
            $table->unsignedBigInteger("first_club_id");
            $table->unsignedBigInteger("second_club_id");
            $table->integer("first_club_score")->default(0);
            $table->integer("second_club_score")->default(0);
            $table->string("first_score_code");
            $table->string("second_score_code");
            $table->timestamps();

            $table->foreign("first_club_id")->references("id")->on("clubs");
            $table->foreign("second_club_id")->references("id")->on("clubs");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');
    }
};
