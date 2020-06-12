<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id_room');
            $table->integer('user_id');
            $table->integer('building_id');
            $table->string('nama_ruangan');
            $table->string('foto_ruangan');
            $table->string('deskripsi');
            $table->string('aturan');
            $table->integer('kapasitas');
            $table->integer('lantai');
            $table->string('foto_denah');
            $table->string('status_ruangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
