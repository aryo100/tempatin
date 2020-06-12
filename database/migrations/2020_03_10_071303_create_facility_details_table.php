<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacilityDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_details', function (Blueprint $table) {
            $table->bigIncrements('id_facility_detail');
            $table->integer('facility_category_id');
            $table->integer('room_id');
            $table->string('merk_fasilitas');
            $table->string('foto_fasilitas');
            $table->string('status_fasilitas');
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
        Schema::dropIfExists('facility_details');
    }
}
