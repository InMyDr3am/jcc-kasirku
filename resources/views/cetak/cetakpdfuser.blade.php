<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <title>Cetak Data User</title>
    
    <style>
        table.static {
            position: relative;
            border: 1 px solid #543535; 
        }
    </style>
</head>

<body>
    <div class="form-group" id="content">
        <p align="center"><b>Laporan Data User</b></p>   
        <table class="static" align="center" rules="all" border="1px" style="width: 95%;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($user as $key => $usr)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $usr->name }}</td>
                        <td>{{ $usr->email }}</td>
                        <td>{{ $usr->email }}</td>
                        <td>{{ $usr->role->role }}</td>
                    </tr>
                @empty
                    <h1>Data Kosong</h1>
                @endforelse
            </tbody>
        </table><br><br>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>