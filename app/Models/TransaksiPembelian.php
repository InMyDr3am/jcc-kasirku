<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class TransaksiPembelian extends Model
{
    // use HasFactory;
    protected $table = 'transaksi_pembelian';
    protected $fillable = ["total_harga"];

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('l, d F Y H:i'); 
    }

    //1 transaksi punya banyak transaksi pembelian barang
    public function transaksi_pembelian_barang()
    {
        return $this->hasMany('App\Models\Transkasi_pembelian_barang');
    }
}
