<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTempsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transaksi_temps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('kd_transaksi', 15);
            $table->char('kd_barang', 10);
            $table->text('nama_barang');
            $table->integer('qty');
            $table->integer('harga');
            $table->integer('sub_total');
            // $table->enum('status', ['Sudah Dibayar', 'Belum Dibayar']);
            $table->date('tgl_transaksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_temps');
    }
}
