<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jja_id')->unsigned();
            $table->string('user_id')->unique();
            $table->string('kode');
            $table->string('status');
            $table->string('name_dsn');
            $table->string('tmptlahir');
            $table->date('tgl_lahir');
            $table->string('email')->unique();
            $table->string('no_telepon');
            $table->char('alamat');
            $table->string('picture')->nullable();
            $table->timestamps();

            $table->foreign('jja_id')->references('id')->on('jjas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dosens');
    }
}
