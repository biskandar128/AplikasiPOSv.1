
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link href="{{url('backend/css/sb-admin-2.min.css')}}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        tr td {
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        
    <p style="font-size: 16px; font-weight: bold;" class="text-center">Invoice Pembelian</p>
    <table>
        <tr>
            <td>Kode Transaksi</td>
            <td>:</td>
            <td width="100">{{ $transaksi->kd_transaksi }}</td>
            <td>Total Pembelian</td>
            <td>:</td>
            <td>{{ $total }}</td>
        </tr>
        <tr>
            <td>Tanggal Transaksi</td>
            <td>:</td>
            <td>{{ \Jenssegers\Date\Date::parse($transaksi->tgl_transaksi)->locale('id')->format('l, d F Y') }}</td>
        </tr>
    </table>
    
    <table class="table table-borderless" style="font-size:10px;">

        <!--Table head-->
        <thead style="border-bottom: double;">
            <tr>
            <th>#</th>
            <th>Nama Barang</th>
            <th>Kode Barang</th>
            <th>Harga Barang</th>
            <th>Qty</th>
            <th>Sub Total</th>
            </tr>
        </thead>
        <!--Table head-->

        <!--Table body-->
        <tbody>
        @foreach ($cetak as $transaksi)
            <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $transaksi->nama_barang }}</td>
            <td>{{ $transaksi->kd_barang }}</td>
            <td>{{ $transaksi->harga }}</td>
            <td>{{ $transaksi->qty  }}</td>
            <td>{{ $transaksi->sub_total }}</td>
            </tr>
            
        @endforeach
            
        </tbody>
        <!--Table body-->


    </table>
</div>
</body>
</html>
    
    