@extends('layout.master')
@section('judul')
    Halaman Detail User
@endsection

@section('content')
    <div class="row justify-content-md-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body box-profile">
                    <div class="text-center">
                        User
                    </div>
                    <h3 class="profile-username text-center">{{ $user->name }}</h3>
                    <p class="text-muted text-center">{{ $user->role->role }}</p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Username</b> <b class="float-right">{{ $user->username }}</b>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b> <b class="float-right">{{ $user->email }}</b>
                        </li>
                        <li class="list-group-item">
                            <b>Jabatan</b> <b class="float-right">{{ $user->role->role }}</b>
                        </li>
                    </ul>
                    <a href="/user" class="btn btn-primary btn-block"><b>Kembali</b></a>
                </div>
            </div>
        </div>
    </div>
@endsection
