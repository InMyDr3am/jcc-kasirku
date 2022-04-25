<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'master_barang';
    protected $fillable = ["nama_barang", "harga_satuan"];

    //1 barang ada di banyak transaksi pembelian barang
    public function transaksi_pembelian_barang()
    {
        return $this->hasMany('App\Transkasi_pembelian_barang');
    }
}
