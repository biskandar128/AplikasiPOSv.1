@foreach ($details as $detail)
    <tr>
    <th scope="row">{{ $loop->iteration }}</th>
    <td>{{ $detail->kd_gudang }}</td>
    <td>{{ $detail->kd_supplier }}</td>
    <td>{{ $detail->kd_barang }}</td>
    <td>Rp. {{ number_format($detail->harga_supplier, 2, ',', '.') }}</td>
    <td>Rp. {{ number_format($detail->harga_jual, 2, ',', '.') }}</td>
    <td>{{ $detail->stok }}</td>
    <td>{{ $detail->status_harga }}</td>
    </tr>
@endforeach

<tr>
<td colspan=9>
<div class="float-right">{{ $details->links() }}</div>
</td>
</tr>