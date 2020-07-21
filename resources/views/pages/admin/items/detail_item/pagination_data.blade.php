@foreach ($details as $detail)
    <tr>
    <th scope="row">{{ $loop->iteration }}</th>
    <td>{{ $detail->kd_barang }}</td>
    <td>{{ $detail->nama_barang }}</td>
    <td>{{ $detail->kd_jenis }}</td>
    <td>{{ $detail->berat }}</td>
    <td>
        <div class="row justify-content-center">
            {{-- Delete Action --}}
            <form action="{{ url('/admin/detail_barang/' . $detail->id) }}" method="post" id="hapus_item">
            @method('delete')
            @csrf
            <button href="#" class="btn btn-danger" title="Hapus Data">
                <span class="icon text-white-150">
                <i class="fas fa-trash"></i>
                </span>
            </button>
            </form>

            <div class="ml-1"></div>
            <a href="/admin/detail_barang/{{ $detail->id }}/edit" class="btn btn-primary" title="Ubah Data">
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
<div class="float-right">{{ $details->links() }}</div>
</td>
</tr>