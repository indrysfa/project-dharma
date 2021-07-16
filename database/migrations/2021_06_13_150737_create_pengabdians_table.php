<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengabdiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengabdians', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('periode_id')->unsigned();
            $table->string('judul_pkm');
            $table->string('nama_komunitas');
            $table->string('lokasi_pkm');
            $table->timestamps();

            $table->foreign('periode_id')->references('id')->on('periodes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengabdians');
    }
}
