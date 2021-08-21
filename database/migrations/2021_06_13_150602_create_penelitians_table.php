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
            $table->bigInteger('dosen_id')->unsigned();
            $table->bigInteger('periode_id')->unsigned();
            $table->bigInteger('jenis_penelitian_id')->unsigned()->nullable();
            $table->bigInteger('status_id')->unsigned();
            $table->string('tgl_penelitian')->nullable();
            $table->string('judul_penelitian');
            $table->integer('jumlah_anggota');
            $table->timestamps();

            $table->foreign('dosen_id')->references('id')->on('dosens')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('jenis_penelitian_id')->references('id')->on('jenis_penelitians')->onUpdate('cascade')->onDelete('cascade');
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
