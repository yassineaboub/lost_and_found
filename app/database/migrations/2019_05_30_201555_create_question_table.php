<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question', function (Blueprint $table) {
            $table->bigIncrements('id_quest');
            $table->text('question');
            $table->unsignedBigInteger('id_obj');
            $table->unsignedBigInteger('id_category');
            $table->timestamps();
            $table->foreign('id_category')->references('id_cat')->on('category');
            $table->foreign('id_obj')->references('id_objet')->on('objet');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question');
    }
}
