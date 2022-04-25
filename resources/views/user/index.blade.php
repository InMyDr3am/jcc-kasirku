@extends('layout.master')
@section('judul')
    Halaman Data User
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
    <a href="/user/create" class="btn btn-primary"><i class="fas fa-thin fa-plus"></i> Tambah Data </a>
    <br><br>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th><center>Aksi</center></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($user as $key => $usr)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $usr->name }}</td>
                    <td>{{ $usr->username }}</td>
                    <td>{{ $usr->email }}</td>
                    <td>{{ $usr->role->role }}</td>
                    <td>
                        <form action="/user/{{ $usr->id }}" method="POST">
                            @csrf
                            @method('delete')
                            <center>
                                <a href="/user/{{ $usr->id }}" class="btn btn-success btn-sm"><i class="fas fa-duotone fa-eye"></i></a>
                                <a href="/user/{{ $usr->id }}/edit" class="btn btn-warning btn-sm"><i class="fas fa-duotone fa-pen"></i></a>
                                <input type="submit" class="btn btn-danger btn-sm" onclick="" value="Delete">
                            </center>
                        </form>
                    </td>
                </tr>
            @empty
                <h1>Data Kosong</h1>
            @endforelse
        </tbody>
    </table><br><br>
@endsection

