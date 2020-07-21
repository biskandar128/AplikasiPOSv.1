<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnBarangsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('return_barangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('kd_return')->unique();
            $table->date('tgl_return');
            $table->text('nama');
            $table->text('alasan_return');
            $table->text('alamat_return');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('return_barangs');
    }
}
