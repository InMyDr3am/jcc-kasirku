<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <title>Cetak Transaksi</title>
    
    <style>
        table.static {
            position: relative;
            border: 1 px solid #543535; 
        }
    </style>
</head>

<body>
    <div class="form-group" id="content">
        <p align="center"><b>Laporan Data Transaksi</b></p>
        <table class="static" border = '0' align="center" style="width: 95%;">
            <td align='left'>
                <b>Faktur Pesanan</b><br>
                <b>Id Trans. : {{ $transaksi->id }}</b><br>
                Tanggal Trans: {{ $transaksi->created_at }}<br>
            </td>
        </table><br>   
        <table class="static" align="center" rules="all" border="1px" style="width: 95%;">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
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
                        <td colspan ='5'style='text-align:right'><b> Total yang harus dibayar adalah @currency($transaksi->total_harga)</b></td>
                        {{-- <td style='text-align:right'>@currency($transaksi->total_harga)</td> --}}
                    </tr>
            </tbody>
        </table>  
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>