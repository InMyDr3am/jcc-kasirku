@extends('layout.master')
@section('judul')
    Halaman Data Barang
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.5/datatables.min.css"/>
@endpush

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <a href="/barang/create" class="btn btn-primary"><i class="fas fa-thin fa-plus"></i> Tambah Data</a>
    <br><br>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Produk</th>
                <th>Harga Satuan</th>
                <th><center>Aksi</center></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($barang as $key => $brg)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $brg->nama_barang }}</td>
                    <td style='text-align:right'> @currency($brg->harga_satuan) </td>
                    <td>
                        <form action="/barang/{{ $brg->id }}" method="POST">
                            @csrf
                            @method('delete')
                            <center>
                                <a href="/barang/{{ $brg->id }}" class="btn btn-success btn-sm"><i class="fas fa-duotone fa-eye"></i></a>
                                <a href="/barang/{{ $brg->id }}/edit" class="btn btn-warning btn-sm"><i class="fas fa-duotone fa-pen"></i></a>
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
