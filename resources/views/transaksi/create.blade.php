@extends('layout.master')
@section('judul')
    Pendataan Transaksi
@endsection

@section('content')
    <form action="/transaksi/create" method="GET">
        @csrf
        <div class="form-group">
            <label>Barang</label>
            <select class="form-control" name="master_barang_id">
                @foreach ($barang as $brg)
                    <option value="{{ $brg->id }}">{{ $brg->nama_barang }}</option>
                @endforeach
            </select>
        </div>
        @error('master_barang_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label>Jumlah</label>
            <input type="number" min="1"  class="form-control" name="jumlah" onkeypress="return event.charCode >= 48 && event.charCode <=57">
        </div>
        @error('jumlah')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form><br>
    @if(empty($cart) || count($cart) ==0)
        Tidak ada Produk di Cart
    @else
        <h2 class="fs-3 text-center my-3">List Cart</h2>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Barang</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th><center>Aksi</center></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $key => $ct) 
                    <tr>
                        <th scope="row">{{ $key  }}</th>
                        <td>{{ $ct["nama_barang"] }}</td>
                        <td>{{ $ct["harga_satuan"] }}</td>
                        <td>{{ $ct["jumlah"] }}</td>
                        <td style='text-align:right'>@currency($ct["subtotal"])</td>
                        <td style='text-align:center'>        
                            <a href="{{ url('/cart/hapus/'.$key) }}" class="btn btn-danger btn-sm" onclick=""><i class="fas fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="4" style='text-align:right'>Total</th>
                    <th style='text-align:right'>@currency($total)</th>
                    <th></th>
                </tr>
            </tbody>
        </table>
        <a href="{{ url('/cart/simpan') }}"><input type="submit" class="btn btn-success" onclick="" value="Simpan"></a>        
    @endif
@endsection
