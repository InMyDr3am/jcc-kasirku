@extends('layout.master')
@section('judul')
     Cari Transaksi
@endsection

@push('scripts')
    <script src="{{ asset('layout/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('layout/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable();
        });
    </script>
@endpush

@push('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.5/datatables.min.css" />
@endpush

@section('content')
<div class="container my-4">
    <div class="row">
        <h2 class="fs-3 text-center my-3">Pencarian Data Transaksi Berdasarkan Kombinasi Barang</h2>
        <div class="my-2">
            <form action="/transaksi-cari/kombinasi" method="GET">
                <div class="input-group mb-3">
                    <select class="form-control" id="" name="barang1">
                        <option value="">--Pilih Barang--</option>
                        @foreach ($barang as $brg)
                            <option value="{{ $brg->id }}">{{ $brg->nama_barang }}</option>
                        @endforeach
                    </select>
                    <select class="form-control" id="" name="barang2">
                        <option value="">--Pilih Barang--</option>
                        @foreach ($barang as $brg)
                            <option value="{{ $brg->id }}">{{ $brg->nama_barang }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </form>
        </div>
        <table id="example1" class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">Waktu Transaksi</th>
                    <th scope="col"> <center>Aksi</center></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksi as $key => $trn)
               
               @if($trn->jumlah > 1)
               
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $trn->id_beli }}</td>
                    <td> {{ Carbon\Carbon::parse($trn->created_at)->translatedFormat('l, d F Y H:i') }} </td>
                    <td>             
                        <center><a href="/transaksi/{{ $trn->id_beli }}" class="btn btn-success btn-sm">Detail</a></center>      
                    </td>
                </tr>
              
                    
                  
                  @endif
                @empty
                    <h1>Data Kosong</h1>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection