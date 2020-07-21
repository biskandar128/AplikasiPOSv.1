<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanStoksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('laporan_stoks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('kd_barang', 10);
            $table->char('nama_barang');
            $table->char('harga_beli');
            $table->char('stok_awal');
            $table->char('stok_masuk');
            $table->char('stok_keluar');
            $table->char('stok_akhir');
            $table->date('tgl');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('laporan_stoks');
    }
}
