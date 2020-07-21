<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGudangsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('gudangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('kd_gudang', 10)->unique();
            $table->char('kd_supplier', 10);
            $table->char('kd_barang', 10);
            $table->char('harga_supplier');
            $table->char('harga_jual');
            $table->integer('stok');
            $table->integer('stok_out');
            $table->enum('status_harga', ['Harga Tidak Aktif', 'Harga Aktif']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('gudangs');
    }
}
