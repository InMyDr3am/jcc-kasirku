@extends('layout.master')
@section('judul')
    Rincian Data Pesanan
@endsection

@section('content')

    <div class="row justify-content-md-center">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body box-profile">
                {{-- <a href="/export-penyucian/{{$penyucian->id}}/toPDF" class="btn btn-danger" style="float: right;" target="_blank">To PDF</a> --}}

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
                                    <th>Nama Produk</th>
                                    <th style='text-align:center'>Harga</th>
                                    <th style='text-align:center'>Jumlah</th>
                                    <th><center>Subtotal</center></th>
                                </tr>
                            </thead>
                            <tbody>
                              

                                @foreach ($transaksi_detail as $key => $trn) 
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $trn->barang->nama_barang }}</td>
                                    <td style='text-align:right'> @currency($trn->barang->harga_satuan) </td>
                                    <td style='text-align:right'>{{ $trn["jumlah"] }}</td>
                                    <td style='text-align:right'>@currency($trn["subtotal"])</td>
                                </tr>
                                @endforeach

                                    <tr> 
                                        <td colspan ='4'style='text-align:right'> Total yang harus dibayar adalah  </td>
                                        <td style='text-align:right'>@currency($transaksi->total_harga)</td>
                                    </tr>
                            </tbody>
                        </table>  
                    </center><br>
                    
                    <a href="/cetak/pdf/{{ $transaksi->id }}" class="btn btn-secondary btn-lg" style="float;" target="_blank"><i class=" fas fa-solid fa-file-pdf"></i></a>
                    <a href="/cetak/print-thermal/{{ $transaksi->id }}" class="btn btn-secondary btn-lg" style="float: right;" target="_blank"><i class="fas fa-solid fa-print"></i></a>
                </div>
            </div><br>
            <button type="button" class="btn btn-primary"  onclick="history.back();"><b>Kembali</b></button>
        </div>
    </div>
@endsection
