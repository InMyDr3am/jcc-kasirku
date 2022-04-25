@extends('layout.master')
@section('judul')
    Edit Rincian Pesanan
@endsection

@section('content')
    <form action="/detail_transaksi/{{ $detail_transaksi->id }}/update" method="POST">
        @csrf
        @method('put')
        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" readonly class="form-control" value ="{{ $detail_transaksi->barang->nama_barang }}">
        </div>
        <div class="form-group">
            <label>Jumlah</label>
            <input type="number" min="1" class="form-control" value ="{{ $detail_transaksi->jumlah }}" name="jumlah" onkeypress="return event.charCode >= 48 && event.charCode <=57">
        </div>
        @error('jumlah')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
