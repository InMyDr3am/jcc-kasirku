@extends('layout.master')
@section('judul')
    Halaman Detail barang
@endsection

@section('content')
    <div class="row justify-content-md-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body box-profile">
                    <div class="text-center">
                        barang
                    </div>
                    <h3 class="profile-barangname text-center">{{ $barang->nama_barang }}</h3>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Nama Barang</b> <b class="float-right">{{ $barang->nama_barang }}</b>
                        </li>
                        <li class="list-group-item">
                            <b>Harga</b> <b class="float-right"> @currency($barang->harga_satuan) </b>
                        </li>
                    </ul>
                    <a href="/barang" class="btn btn-primary btn-block"><b>Kembali</b></a>
                </div>
            </div>
        </div>
    </div>
@endsection
