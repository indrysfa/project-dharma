<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenelitiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penelitians', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('periode_id')->unsigned();
            $table->bigInteger('status_id')->unsigned();
            $table->string('judul_penelitian');
            $table->integer('jumlah_anggota');
            $table->timestamps();

            $table->foreign('periode_id')->references('id')->on('periodes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('statuses')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penelitians');
    }
}
