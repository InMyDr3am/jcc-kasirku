<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_barang' => 'required',
                'harga_satuan' => 'required',
            ],
            [
                'nama_barang.required' => 'Nama Barang Harus diisi !',
                'harga_satuan.required' => 'Harga Satuan Harus diisi !',
            ]
        );

        $barang = new Barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->harga_satuan = $request->harga_satuan;
        $barang->save();

        return redirect('/barang')->with('success', 'Data Barang Berhasil Ditambah');
    }

    
    public function show($id)
    {
        $barang = Barang::find($id);

        return view('barang.show', compact('barang'));
    }

    
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);

        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nama_barang' => 'required',
                'harga_satuan' => 'required',
            ],
            [
                'nama_barang.required' => 'Nama Barang Harus diisi !',
                'harga_satuan.required' => 'Harga Satuan Harus diisi !',
            ]
        );


        $barang = Barang::find($id);
        $barang->nama_barang = $request->nama_barang;
        $barang->harga_satuan = $request->harga_satuan;
        $barang->save();

        return redirect('/barang')->with('success', 'Data Barang Berhasil Diubah');
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();
        return redirect('/barang')->with('success', 'Data Barang Berhasil dihapus');
    }
}
