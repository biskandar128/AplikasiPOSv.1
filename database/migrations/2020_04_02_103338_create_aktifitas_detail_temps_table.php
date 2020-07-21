<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAktifitasDetailTempsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('aktifitas_detail_temps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('kd_aktivitas', 12);
            $table->char('aktifitas');
            $table->date('tgl_aktifitas');
            $table->integer('total_biaya');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('aktifitas_detail_temps');
    }
}
