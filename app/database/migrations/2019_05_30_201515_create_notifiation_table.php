<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifiationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifiation', function (Blueprint $table) {
            $table->bigIncrements('id_notif');
            $table->text('txt');
            $table->unsignedBigInteger('id_user_notif');
            $table->unsignedBigInteger('id_ann_notif');
            $table->timestamps();
            $table->foreign('id_user_notif')->references('id')->on('users');
            $table->foreign('id_ann_notif')->references('id_annonce')->on('annonce');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifiation');
    }
}
