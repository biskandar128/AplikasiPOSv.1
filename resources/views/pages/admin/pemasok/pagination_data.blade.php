@foreach ($data as $supplier)
    <tr>
    <th scope="row">{{ $loop->iteration }}</th>
    <td>{{ $supplier->kd_supplier }}</td>
    <td>{{ $supplier->nama_supplier }}</td>
    <td>{{ $supplier->kd_barang }}</td>
    <td>{{ $supplier->qty }}</td>
    <td>Rp {{ number_format($supplier->harga_beli,0,',','.') }}</td>
    <td>{{ $supplier->tgl_barang_datang }}</td>
    <td>
        <div class="row justify-content-center">
            <form action="{{ url('/admin/pemasok/' . $supplier->id) }}" method="post" id="hapus_supplier">
            @method('delete')
            @csrf
            <div></div>
            <button href="#" class="btn btn-danger" title="Hapus Data">
                <span class="icon text-white-150">
                <i class="fas fa-trash"></i>
                </span>
            </button>
            </form>
            <div class="ml-1"></div>
            <a href="/admin/pemasok/{{ $supplier->id }}/edit" class="btn btn-primary" title="Ubah Data">
                <span class="icon text-white-150">
                <i class="fa fa-edit"></i>
                </span>
            </a>
        </div>
    </td>
    </tr>
@endforeach

<tr>
<td colspan=8>
<div class="float-right">{{ $data->links() }}</div>
</td>
</tr>