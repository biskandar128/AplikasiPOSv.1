@foreach ($reports as $report)
    <tr align="center">
    <th scope="row">{{ $loop->iteration }}</th>
    <td>{{ \Jenssegers\Date\Date::parse($report->tgl_transaksi)->locale('id')->format('d F Y') }}</td>
    <td><a href="{{ url('/admin/laporan-stok-out/' . $report->kd_transaksi) }}" class="btn-link">{{ $report->kd_transaksi }}</a></td>
    <td>Rp. {{ number_format($report->total, 2, ',', '.') }}</td>
    </tr>
@endforeach

<tr>
<td colspan=8>
<div class="float-right">{{ $reports->links() }}</div>
</td>
</tr>
