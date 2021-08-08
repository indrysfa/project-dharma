<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajarans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('dosen_id')->unsigned();
            $table->bigInteger('periode_id')->unsigned();
            $table->bigInteger('status_id')->unsigned();
            $table->integer('kode_mk');
            $table->string('nama_mk');
            $table->string('kelas');
            $table->integer('sks');
            $table->timestamps();

            $table->foreign('dosen_id')->references('id')->on('dosens')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('pengajarans');
    }
}
