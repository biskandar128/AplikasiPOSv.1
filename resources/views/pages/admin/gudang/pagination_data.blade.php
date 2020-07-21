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
    <td>
        <div class="row justify-content-center">
            {{-- Delete Action --}}
            <form action="{{ url('/admin/gudang/' . $detail->id) }}" method="post" id="hapus_gudang">
            @method('delete')
            @csrf
            <div class="ml-1"></div>
            <button href="#" class="btn btn-danger" title="Hapus Data">
                <span class="icon text-white-150">
                <i class="fas fa-trash"></i>
                </span>
            </button>
            </form>

            <div class="ml-1"></div>
            <a href="/admin/gudang/{{ $detail->id }}/edit" class="btn btn-primary" title="Ubah Data">
                <span class="icon text-white-150">
                <i class="fa fa-edit"></i>
                </span>
            </a>
        </div>
    </td>
    </tr>
@endforeach

<tr>
<td colspan=9>
<div class="float-right">{{ $details->links() }}</div>
</td>
</tr>