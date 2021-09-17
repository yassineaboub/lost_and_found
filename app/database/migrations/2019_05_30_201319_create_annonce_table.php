<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnonceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annonce', function (Blueprint $table) {
            $table->bigIncrements('id_annonce');
            $table->date('dateaction');
            $table->date('datefin')->nullable();
            $table->text('description')->nullable();
            $table->string('etat')->nullable();
            $table->string('image')->nullable();
            $table->string('nom')->nullable();
            $table->string('lattitude')->nullable();
            $table->string('longitude')->nullable();    
            $table->string('ville')->nullable();
            $table->string('region')->nullable();
            $table->integer('nb_signal')->nullable();    
            $table->integer('id_reponse0')->nullable();
            $table->integer('id_question0')->nullable();
            $table->integer('id_reponse1')->nullable();
            $table->integer('id_question1')->nullable();
            $table->integer('id_reponse2')->nullable();
            $table->integer('id_question2')->nullable();
            $table->unsignedBigInteger('id_user_ann');
            $table->unsignedBigInteger('id_object');
            $table->timestamps();
            $table->foreign('id_user_ann')->references('id')->on('users');
            $table->foreign('id_object')->references('id_objet')->on('objet');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annonce');
    }
}
