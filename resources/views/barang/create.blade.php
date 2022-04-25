@extends('layout.master')
@section('judul')
    Tambah Data Barang
@endsection

@section('content')
    <form action="/barang" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" class="form-control" name="nama_barang" value="{{ old('nama_barang') }}">
        </div>
        @error('nama_barang')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label>Harga Satuan</label>
            <input type="text" class="form-control" name="harga_satuan" value="{{ old('harga_satuan') }}">
        </div>
        @error('harga_satuan')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
@endsection
