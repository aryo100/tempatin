<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promos', function (Blueprint $table) {
            $table->bigIncrements('id_promo');
            $table->integer('room_id');
            $table->integer('user_id');
            $table->string('gambar_promo');
            $table->string('nama_promo');
            $table->integer('diskon');
            $table->integer('nominal');
            $table->integer('batas_durasi_per_jam');
            $table->integer('kuota');
            $table->string('deskripsi');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('role_id');
            $table->string('room_or_building_id');
            $table->string('status_penyebaran');
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
        Schema::dropIfExists('promos');
    }
}
