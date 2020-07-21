<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnBarangDetailsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('return_barang_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('kd_return');
            $table->char('kd_transaksi');
            $table->char('kd_gudang');
            $table->integer('qty');
            $table->integer('sub_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('return_barang_details');
    }
}
