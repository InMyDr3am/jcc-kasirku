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
        <h2 class="fs-3 text-center my-3">Pencarian Data Transaksi Berdasarkan Tanggal</h2>
        <div class="my-2">
            <form action="/transaksi-cari/tanggal" method="GET">
                <div class="input-group mb-3">
                    <input type="date" class="form-control" name="start_date" placeholder="Pilih Tanggal Awal">
                    <input type="date" class="form-control" name="end_date" placeholder="Pilih Tanggal Akhir">
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
                    <th scope="col">Total Harga</th>
                    <th scope="col"> <center>Aksi</center></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksi as $key => $trn)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $trn->id }}</td>
                        <td>{{ $trn->created_at }}</td>
                        <td style='text-align:right'>@currency($trn->total_harga) </td>
                        <td>
                            <center><a href="/transaksi/{{ $trn->id }}" class="btn btn-success btn-sm">Detail</a></center>      
                        </td>
                    </tr>
                @empty
                    <h1>Data Kosong</h1>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection