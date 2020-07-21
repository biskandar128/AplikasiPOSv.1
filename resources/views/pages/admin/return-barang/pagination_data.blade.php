@foreach ($details as $detail)
    <tr>
    <th scope="row">{{ $loop->iteration }}</th>
    <td><a href="{{ url('/admin/detail-return/' . $detail->kd_return) }}">{{ $detail->kd_return }}</a></td>
    <td>{{ $detail->tgl_return }}</td>
    <td>{{ $detail->nama }}</td>
    <td>{{ $detail->alasan_return }}</td>
    <td>{{ $detail->alamat_return }}</td>
    <td>Rp. {{ number_format($detail->total, 2, ',', '.') }}</td>
    <td>
        <div class="row justify-content-center">
            <form action="{{ url('/admin/detail-return-barang/' . $detail->kd_return) }}" method="post" id="hapus_return">
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
            <a href="/admin/detail-return-barang/{{ $detail->kd_return }}/edit" class="btn btn-primary" title="Ubah Data">
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
