<?php

namespace App\Http\Controllers;

use App\Models\Barang;

use Illuminate\Support\Facades\DB;
use App\Models\TransaksiPembelian;
use App\Models\TransaksiPembelianBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;


class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = TransaksiPembelian::all();
        return view('transaksi.index', compact('transaksi'));

    }

    public function create()
    {
         
        $barang = Barang::all();
        $total = 0;
        $cart = session("cart");

        //jika tidak ada data baru masuk dan blm ada data maka
        if( null == $cart and empty(request()->master_barang_id) and empty(request()->jumlah)) {
            $cart = session("cart");
            return view('transaksi.create', compact('barang','total'));
        }    

        //cek kondisi jika ada inputan baru
        if (request()->master_barang_id and request()->jumlah ) 
        {
            $master_barang_id = request()->master_barang_id;
            $jumlah = request()->jumlah;
           
            $produk = Barang::find($master_barang_id);
            $subtotal = $produk->harga_satuan * $jumlah;
            $cart[$master_barang_id] = [
                            "nama_barang" => $produk->nama_barang,
                            "harga_satuan" => $produk->harga_satuan,
                            "jumlah" => $jumlah,
                            "subtotal" => $subtotal,
                        ];
            session(["cart" => $cart]);
            foreach($cart as $key => $ct)
            {
                $subtotal = $ct["subtotal"];
                $total+= $subtotal;
            }
            
            return view('transaksi.create', compact('barang','total'))->with("cart",$cart);
        } 

        //jika tidak ada inputan baru maka cek apakah ada data yang sudah tersimpan di sesion cart atau belum
        elseif (!empty('cart'))
        {
            
            foreach($cart as $key => $ct)
            {
                $subtotal = $ct["subtotal"];
                $total+= $subtotal;
            }
            return view('transaksi.create', compact('barang','total'))->with("cart",$cart);
        }

    }

    public function hapus_cart($id)
    {
        $cart = session("cart");
        unset($cart[$id]);
        session(["cart" => $cart]);
        return redirect("/transaksi/create");
    }

    public function simpan(){
        
       
        $cart = session("cart");
        $total = 0;
        foreach ($cart as $key => $ct){
            $subtotal = $ct["subtotal"];
            $total+= $subtotal;
        }
        $transaksi_pembelian = TransaksiPembelian::create([
            'total_harga' => $total,
        ]);

        foreach ($cart as $key => $ct){
            TransaksiPembelianBarang::create([
                'transaksi_pembelian_id' => $transaksi_pembelian->id,
                'master_barang_id' => $key,
                'jumlah' => $ct["jumlah"],
                'subtotal' => $ct["subtotal"],
            ]);
        }

        session()->forget("cart");

        return redirect("/transaksi");
    }
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = TransaksiPembelian::find($id);
        $transaksi_pembelian_id = $transaksi->id;
        $transaksi_detail = TransaksiPembelianBarang::where('transaksi_pembelian_id', $transaksi_pembelian_id)->get();
        return view('transaksi.show', compact('transaksi','transaksi_detail'));
        
    }

   
    public function edit($id)
    {
        $barang = Barang::all();
        $transaksi = TransaksiPembelian::find($id);
        $transaksi_pembelian_id = $transaksi->id;
        $transaksi_detail = TransaksiPembelianBarang::where('transaksi_pembelian_id', $transaksi_pembelian_id)->get();
        
        return view('transaksi.edit', compact('transaksi','transaksi_detail','barang'));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'master_barang_id' => 'required',
                'jumlah' => 'required',
            ],

            [
                'master_barang_id.required' => 'Pilih Barang Dulu',
                'jumlah.required' => 'Jumlah tidak boleh kosong',
            ]
        );

        $barang = Barang::find($request->master_barang_id);

        $transaksi = new TransaksiPembelianBarang;
        $transaksi->transaksi_pembelian_id = $id;
        $transaksi->master_barang_id = $request->master_barang_id;
        $transaksi->jumlah = $request->jumlah;
        $transaksi->subtotal = $request->jumlah * $barang->harga_satuan;
        $transaksi->save();

        $update_transaksi = TransaksiPembelian::find($id);
        $total_harga_akhir = $update_transaksi->total_harga + $barang->harga_satuan * $request->jumlah;
        $update_transaksi->total_harga = $total_harga_akhir;
        $update_transaksi->save();
        return redirect('/transaksi');
    }

    public function destroyRincian($id)
    {
        $detail_transaksi = TransaksiPembelianBarang::find($id);
        $transaksi_pembelian_id = $detail_transaksi->transaksi_pembelian_id;
        $detail_transaksi->delete();
        
        $total_harga_baru = 0;
        $data_sama = TransaksiPembelianBarang::where('transaksi_pembelian_id', $transaksi_pembelian_id)->get();
            
        foreach($data_sama as $data)
        {
            $total_harga_baru += $data['subtotal'];
        }   
            
        $transaksi = TransaksiPembelian::find($transaksi_pembelian_id);
        $transaksi->total_harga = $total_harga_baru;
        $transaksi->save();
        
        return redirect('/transaksi');
    }

    public function destroy($id)
    {
        $transaksi = TransaksiPembelian::find($id);
        $transaksi_pembelian_id = $transaksi->id;
        
        $detail_pembelian = TransaksiPembelianBarang::where('transaksi_pembelian_id', $transaksi_pembelian_id)->get();
            
        foreach($detail_pembelian as $data)
        {
            $data->delete();
        }   
            
        $transaksi->delete();
        return redirect('/transaksi');
    }

    public function editDetailTransaksi($id)
    {
        $detail_transaksi = TransaksiPembelianBarang::find($id);
       
        return view('detail_transaksi.edit', compact('detail_transaksi'));
    }

    public function updateDetailTransaksi(Request $request, $id)
    {
        $request->validate(
            [
                'jumlah' => 'required',
            ],

            [
                'jumlah.required' => 'Jumlah tidak boleh kosong',
            ]
        );

        $detail_transaksi = TransaksiPembelianBarang::find($id);
        
        $subtotal_baru = $detail_transaksi->barang->harga_satuan * $request->jumlah; 
        $detail_transaksi->jumlah = $request->jumlah;
        $detail_transaksi->subtotal = $subtotal_baru;
        $detail_transaksi->save();

        $total_harga_baru = 0;
        $data_sama = TransaksiPembelianBarang::where('transaksi_pembelian_id', $detail_transaksi->transaksi_pembelian_id)->get();
            
        foreach($data_sama as $data)
        {
            $total_harga_baru += $data['subtotal'];
        }   
            
        $transaksi = TransaksiPembelian::find($detail_transaksi->transaksi_pembelian_id);
        $transaksi->total_harga = $total_harga_baru;
        $transaksi->save();

       
        return redirect('/transaksi');
    }


    public function cariTgl()
    {
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $transaksi = TransaksiPembelian::whereDate('created_at','>=',$start_date)->whereDate('created_at','<=',$end_date)->get();
        } else {
            $transaksi = TransaksiPembelian::latest()->get();
        }
        
        return view('transaksi-cari/tanggal', compact('transaksi'));
    }

    public function cariTotal()
    {
        if (request()->total_awal || request()->total_akhir) {
            $total_awal = request()->total_awal;
            $total_akhir = request()->total_akhir;
            $transaksi = TransaksiPembelian::where('total_harga','>=',$total_awal)->where('total_harga','<=',$total_akhir)->get();
        } else {
            $transaksi = TransaksiPembelian::latest()->get();
        }
        
        return view('transaksi-cari/totalharga', compact('transaksi'));
    }

    public function cariKombinasi()
    {
        $barang1 = 0;
        $barang2 = 0;
        $barang = Barang::all();
        if (request()->barang1 || request()->barang2) {
            $barang1 = request()->barang1;
            $barang2 = request()->barang2;
            $transaksi = DB::table('transaksi_pembelian_barang')
                            ->where('master_barang_id', $barang1)
                            ->orwhere('master_barang_id', $barang2)
                            ->select(['created_at',
                                DB::raw('count(*) as jumlah'),
                                DB::raw('transaksi_pembelian_id as id_beli'),
                                DB::raw('sum(subtotal) as total_harga'),
                            ])
                            ->groupBy('id_beli')
                            ->get();
        

        } else {
            $transaksi = TransaksiPembelian::latest()->get();
        }
        
        return view('transaksi-cari/kombinasi', compact('transaksi','barang','barang1','barang2'));
    }

    public function cetakTransaksi($id)
    {
        $transaksi = TransaksiPembelian::find($id);
       
        $transaksi_detail = TransaksiPembelianBarang::where('transaksi_pembelian_id',$id)->with('barang','transaksi_pembelian')->get();
       
        
        return view('cetak.cetakpdftransaksi', compact('transaksi', 'transaksi_detail'));

       
    }

    public function printThermal($id)
    {
        $transaksi = TransaksiPembelian::find($id);
       
        $transaksi_detail = TransaksiPembelianBarang::where('transaksi_pembelian_id',$id)->with('barang','transaksi_pembelian')->get();
       
        return view('cetak.print-thermal', compact('transaksi', 'transaksi_detail'));

       
    }
}
