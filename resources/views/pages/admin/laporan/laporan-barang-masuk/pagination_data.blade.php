@foreach ($data as $report)
<tr>
<th scope="row">{{ $loop->iteration }}</th>
<td>{{ \Jenssegers\Date\Date::parse($report->tgl)->locale('id')->format('d F Y') }}</td>
<td>{{ $report->nama_barang }}</td>
<td>Rp. {{ number_format($report->harga_beli, 2, ',', '.') }}</td>
<td>{{ $report->stok_awal }}</td>
<td>{{ $report->stok_masuk }}</td>
<td>{{ $report->stok_keluar }}</td>
<td>{{ $report->stok_akhir }}</td>
</tr>

@endforeach

<tr>
<td colspan=8>
<div class="float-right">{{ $data->links() }}</div>
</td>
</tr>

