<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiPembelianBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_pembelian_barang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('transaksi_pembelian_id');
            $table->unsignedBigInteger('master_barang_id');
            $table->integer('jumlah');
            $table->integer('subtotal');
            $table->timestamps();
            $table->foreign('transaksi_pembelian_id')->references('id')->on('transaksi_pembelian');
            $table->foreign('master_barang_id')->references('id')->on('master_barang');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_pembelian_barang');
    }
}
