<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class TransaksiPembelianBarang extends Model
{
    //use HasFactory;
    protected $table = 'transaksi_pembelian_barang';
    protected $fillable = ["transaksi_pembelian_id", "master_barang_id", "jumlah", "subtotal"];

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('l, d F Y H:i'); 
    }

    //tabel transaksi_pembelian_barang punya fk dari transaksi_pembelian
    public function transaksi_pembelian()
    {
        return $this->belongsTo('App\Models\TransaksiPembelian','transaksi_pembelian_id');
    }

    //tabel transaksi_pembelian_barang punya fk dari barang
    public function barang()
    {
        return $this->belongsTo('App\Models\Barang','master_barang_id');
    }
}
