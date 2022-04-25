@extends('layout.master')
@section('judul')
    List Cart
@endsection

@section('content')
    @if(empty($cart) || count($cart) ==0)
        Tidak ada Produk di Cart
    @else
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
                        <th scope="row">{{ $key + 1 }}</th>
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
        <a href="{{ url('/transaksi/create') }}"><button type="button" class="btn btn-primary"><b>Pilih Barang</b></button></a>
        <a href="{{ url('/cart/simpan') }}"><input type="submit" class="btn btn-danger btn-sm" onclick="" value="Simpan"></a>        
    @endif
@endsection
