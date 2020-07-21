@foreach ($jenisitems as $jenis)
<tr>
<th scope="row">{{ $loop->iteration }}</th>
<td>{{ $jenis->kd_jenis }}</td>
<td>{{ $jenis->jenis_barang }}</td>
<td>
    <div class="row justify-content-center">
        <form action="{{ url('/admin/jenis_barang/' . $jenis->id) }}" method="post" id="hapus_jenis_barang">
        @method('delete')
        @csrf
        <button href="#" class="btn btn-danger" title="Hapus Data">
            <span class="icon text-white-150">
            <i class="fas fa-trash"></i>
            </span>
        </button>
        </form>
        <div class="ml-1"></div>
        <a href="/admin/jenis_barang/{{ $jenis->id }}/edit" class="btn btn-primary" title="Ubah Data">
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
<div class="float-right">{{ $jenisitems->links() }}</div>
</td>
</tr>