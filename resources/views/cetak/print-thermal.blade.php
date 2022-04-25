<html>
<head>
    <title>Faktur Pembayaran</title>
    <style>
        #tabel
        {
        font-size:15px;
        border-collapse:collapse;
        }
        #tabel  td
        {
        padding-left:5px;
        border: 1px solid black;
        }
    </style>
</head>
<body style='font-family:tahoma; font-size:8pt;'>
    <center>
    <table style='width:350px; font-size:16pt; font-family:calibri; border-collapse: collapse;' border = '0'>
        <td width='70%' align='CENTER' vertical-align:top'><span style='color:black;'>
            <b>TOKOKU TOKO SAYA</b></br>JL MERDEKA NO.45</span></br>
            <span style='font-size:12pt'>No. Trans : {{ $transaksi->id }}, {{ $transaksi->created_at }}</span></br>
        </td>
    </table>
    <style>
        hr { 
            display: block;
            margin-top: 0.5em;
            margin-bottom: 0.5em;
            margin-left: auto;
            margin-right: auto;
            border-style: inset;
            border-width: 1px;
        } 
    </style>
    <table cellspacing='0' border="1"cellpadding='0' style='width:350px; font-size:12pt; font-family:calibri;  border-collapse: collapse;' border='0'>
        <tr align='center'>
        <td width='10%'>Item</td>
        <td width='13%'>Harga</td>
        <td width='4%'>Jumlah</td>
        <td width='13%'>Subtotal</td><tr>
        <td colspan='5'></td></tr>
        </tr>
            @foreach ($transaksi_detail as $key => $trn) 
                <tr>
                    <td style='vertical-align:top'>{{ $trn->barang->nama_barang }}</td>
                    <td style='vertical-align:top; text-align:right; padding-right:10px'>@currency($trn->barang->harga_satuan)</td>
                    <td style='vertical-align:top; text-align:right; padding-right:10px'>{{ $trn["jumlah"] }}</td>
                    <td style='text-align:right; vertical-align:top'>@currency($trn["subtotal"])</td>
                </tr>
            @endforeach
        
        <tr> 
            <td colspan ='5'style='text-align:right'><b> Total Harga @currency($transaksi->total_harga)</b></td>
            {{-- <td style='text-align:right'>@currency($transaksi->total_harga)</td> --}}
        </tr>
    </table>
    <table style='width:350; font-size:12pt;' cellspacing='2'><tr></br><td align='center'>****** TERIMAKASIH ******</br></td></tr></table>
    </center>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>