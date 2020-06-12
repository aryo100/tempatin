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
            $table->string('kode');
            $table->integer('diskon');
            $table->integer('used_times');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status_ter_ruangan');
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
