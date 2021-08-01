<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengembangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengembangans', function (Blueprint $table) {
            $table->id();
            $table->string('dosen_id');
            $table->bigInteger('periode_id')->unsigned();
            $table->bigInteger('jenis_pengdiri_id')->unsigned();
            $table->string('judul_pengdiri');
            $table->string('lokasi_pengdiri');
            $table->timestamps();

            $table->foreign('periode_id')->references('id')->on('periodes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('jenis_pengdiri_id')->references('id')->on('jenis_pengdiris')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengembangans');
    }
}
