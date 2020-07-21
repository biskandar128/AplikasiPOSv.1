<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('kd_transaksi', 15);
            $table->char('kd_gudang', 10);
            $table->date('tgl_transaksi');
            $table->integer('qty');
            $table->integer('sub_total');
            // $table->enum('status', ['Sudah Dibayar', 'Belum Dibayar']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
