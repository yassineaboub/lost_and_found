<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignalerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signaler', function (Blueprint $table) {
            $table->bigIncrements('id_signale');
            $table->text('cause');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_ann');
            $table->timestamps();
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_ann')->references('id_annonce')->on('annonce');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signaler');
    }
}
