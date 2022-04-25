<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $barang = [
            [
                'nama_barang' => 'Sabun batang',
                'harga_satuan' => 3000,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'nama_barang' => 'Mi Instan',
                'harga_satuan' => 2000,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'nama_barang' => 'Pensil',
                'harga_satuan' => 1000,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'nama_barang' => 'Kopi Sachet',
                'harga_satuan' => 1500,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'nama_barang' => 'Air Minum Galon',
                'harga_satuan' => 20000,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
        ];
            
        \DB::table('master_barang')->insert($barang);
    }
}
