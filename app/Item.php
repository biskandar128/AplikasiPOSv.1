<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['kd_barang', 'nama_barang', 'kd_jenis', 'harga_jual', 'stok', 'status_harga', 'tgl_status_harga', 'berat'];
}
