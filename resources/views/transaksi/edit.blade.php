@extends('layout.master')
@section('judul')
    Edit Data Transaksi
@endsection

@section('content')

    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center"><b>Tokoku Toko Saya</b></h3>
                    <h3 class="profile-username text-center">Jalan Merdeka No. 45</h3>
                    <p class="text-muted text-center">Telp : 02233344455</p>
                    <hr>
                        <table style=border-collapse: collapse;' border = '0' center>
                            {{-- <td width='77%' align='left' style='padding-right:80px; vertical-align:top'>
                                <b>Nama : {{ $penyucian->nama_pemesan }}<br>
                                <b>No Hp : {{ $penyucian->no_hp }}<br>
                                <b>Ket. : {{ $penyucian->keterangan }}
                            </td> --}}
                            <td style='vertical-align:top' align='left'>
                                <b>Faktur Pesanan</b><br>
                                <b>Id Trans. : {{ $transaksi->id }}</b><br>
                                Tanggal Trans: {{ $transaksi->created_at }}<br>
                            </td>
                        </table><br>
                        
                        <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Barang</th>
                                        <th style='text-align:center'>Jumlah</th>
                                        <th style='text-align:center'>Harga</th>
                                        <th style='text-align:center'>Sub Total</th>
                                        <th><center>Aksi</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transaksi_detail as $key=> $item)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $item->barang->nama_barang }}</td>
                                            <td style='text-align:right'>{{ $item->jumlah }}</td>
                                            <td style='text-align:right'> @currency($item->barang->harga_satuan) </td>
                                            <td style='text-align:right'> @currency($item->subtotal) </td>
                                            <td>
                                                <form action="/detail_transaksi/{{ $item->id }}" method="POST">
                                                    @csrf
                                                    @method('delete')<center>
                                                    <a href="/detail_transaksi/{{ $item->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                                                    <input type="submit" class="btn btn-danger btn-sm" onclick="" value="Delete"></center>
                                                </form>
                                            </td>
                                        </tr>        
                                    @empty
                                        
                                    @endforelse 
                                        <tr> 
                                            <td colspan ='5'style='text-align:right'> Total yang harus dibayar adalah  @currency($transaksi->total_harga)</td>
                                            <td> </td>
                                        </tr>
                                </tbody>
                            </table>  
                    </center>    
                </div>
                <!-- /.card-body --> 
            </div>

            <br><br><br>
            <h3 class="profile-username text-center">Tambah Data Pesanan </h3>

            <form action="/transaksi/{{ $transaksi->id }}" method="POST">
                @csrf
                @method('put')
                <div class="form-group">
                    <label>Barang</label>
                    <select class="form-control" name="master_barang_id">
                        @foreach ($barang as $brg)
                            <option value="{{ $brg->id }}">{{ $brg->nama_barang }}</option>
                        @endforeach
                    </select>
                </div>
                @error('master_barang_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
        
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" min="1" class="form-control" name="jumlah" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                </div>
                @error('jumlah')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <br>
                <button type="submit" class="btn btn-primary" >Tambah</button></div>     
            </form>
            
            <!-- /.card -->
        </div>
    
@endsection
