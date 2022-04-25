@extends('layout.master')
@section('judul')
     Data Transaksi
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.5/datatables.min.css" />
@endpush

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <a href="/transaksi/create" class="btn btn-primary"><i class="fas fa-thin fa-plus"></i> Tambah Data</a>
    {{-- <a href="/export-transaksi/toExcel" class="btn btn-success" style="float: right;" target="_blank">To Excel</a> --}}
    <br><br>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Waktu Transaksi </th>
                <th style='text-align:center'>Total Harga</th>
                <th style='text-align:center'>Downnload / Print</th>
                <th style='text-align:center'><center>Aksi</center></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksi as $key => $trn)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $trn->id }}</td>
                    <td>{{ $trn->created_at }}</td>
                    <td style='text-align:right'>@currency($trn->total_harga) </td>
                    <td style='text-align:center'>
                        <a href="/cetak/pdf/{{ $trn->id }}" class="btn btn-secondary btn-sm" target="_blank"><i class=" fas fa-solid fa-file-pdf"></i></a>
                        <a href="/cetak/print-thermal/{{ $trn->id }}" class="btn btn-secondary btn-sm" target="_blank"><i class="fas fa-solid fa-print"></i></a>
                    </td>
                    <td>
                        <form action="/transaksi/{{ $trn->id }}" method="POST">
                            @csrf
                            @method('delete')
                            <center>
                            <a href="/transaksi/{{ $trn->id }}" class="btn btn-success btn-sm"><i class="fas fa-duotone fa-eye"></i></a>
                            <a href="/transaksi/{{ $trn->id }}/edit" class="btn btn-warning btn-sm"><i class="fas fa-duotone fa-pen"></i></a>
                            <input type="submit" class="btn btn-danger btn-sm" onclick="" value="Delete">
                            </center>
                        </form>
                    </td>
                </tr>
            @empty
                <h1>Data Kosong</h1>
            @endforelse
        </tbody>
    </table>
@endsection
