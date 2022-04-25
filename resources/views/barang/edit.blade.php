@extends('layout.master')
@section('judul')
    Edit Data Barang
@endsection

@section('content')
    <form action="/barang/{{ $barang->id }}" method="POST">
        @csrf
        @method('put')
        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" class="form-control" name="nama_barang" value="{{ $barang->nama_barang }}">
        </div>
        @error('nama_barang')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label>Harga </label>
            <input type="text" class="form-control" name="harga_satuan" value="{{ $barang->harga_satuan }}">
        </div>
        @error('harga_satuan')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
