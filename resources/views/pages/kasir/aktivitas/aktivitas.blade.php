@extends('pages.kasir.master')

@section('title', 'Aktivitas Perusahaan')

@section('content')

<!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Kegiatan Aktifitas Perusahaan</h1>
        </div>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-6 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data Aktifitas</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        

                                {{--  Form Barang Masuk  --}}
                                <form action="{{ url('/kasir/tambah-aktifitas') }}" method="post">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="kd_aktifitas">Kode Aktifitas</label>
                                        <input type="text" id="kd_aktifitas" class="form-control @error('kd_aktifitas') is-invalid @enderror" name="kd_aktifitas" value="{{ $code }}" readonly>
                                        @error('kd_aktifitas')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_aktifitas">Tanggal Aktifitas</label>
                                        <input type="date" id="tgl_aktifitas" class="form-control @error('tgl_aktifitas') is-invalid @enderror" name="tgl_aktifitas" value="{{ old('tgl_aktifitas') }}">
                                        @error('tgl_aktifitas')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="nama_aktifitas">Nama Aktifitas</label>
                                        <input type="text" id="nama_aktifitas" class="form-control @error('nama_aktifitas') is-invalid @enderror" name="nama_aktifitas" placeholder="Masukkan Kegiatan" value="{{ old('nama_aktifitas') }}">
                                        @error('nama_aktifitas')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="biaya_keluar">Biaya dikeluarkan</label>
                                        <input type="number" id="biaya_keluar" class="form-control @error('biaya_keluar') is-invalid @enderror" name="biaya_keluar" value="{{ old('biaya_keluar') }}">
                                        @error('biaya_keluar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="total_biaya">Total Biaya Keluar</label>
                                        <input type="text" id="total_biaya" class="form-control @error('total_biaya') is-invalid @enderror"  name="total_biaya" value="{{ old('total_biaya') }}" readonly>
                                        @error('total_biaya')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <button class="btn btn-primary btn-icon-split" name="btn_tambah" value="tambah_biaya">
                                        <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text">Tambah Data</span>
                                    </button>
                                {{--  End of Form Barang Masuk  --}}


                    </div>
                    
                </div>
            </div>

            <div class="col-xl-6 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">List Aktifitas</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        

                                {{--  Form Barang Masuk  --}}
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-bordered" id="table_aktifitas">
                                        <thead>
                                            <tr>
                                                <th>Nama Aktifitas</th>
                                                <th>Total Biaya Dikeluarkan</th>
                                                <th width="30%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($details as $detail)
                                            <tr>
                                                <td>{{ $detail->aktifitas }}</td>
                                                <td>{{ $detail->total_biaya }}</td>
                                                <td>
                                                    <div class="row justify-content-center">
                                                        
                                                        <a href="form-aktifitas-delete/{{ $detail->aktifitas }}/{{ $detail->kd_aktivitas }}" class="btn btn-danger mr-1" title="Hapus Data" id="hapus_form_aktifitas">
                                                            <span class="icon text-white-150">
                                                            <i class="fas fa-trash"></i>
                                                            </span>
                                                        </a>
                                                        
                                                        <a href="form-aktifitas-update/{{ $detail->aktifitas }}/update/{{ $detail->kd_aktivitas }}" class="btn btn-primary" title="Ubah Data">
                                                            <span class="icon text-white-150">
                                                            <i class="fa fa-edit"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <button class="btn btn-success btn-icon-split" name="btn_selesai" value="selesai_aktifitas">
                                        <span class="icon text-white-50">
                                        <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text">Simpan Data</span>
                                    </button>
                                </form>

                                </div>
                                {{--  End of Form Barang Masuk  --}}


                    </div>
                    
                </div>
            </div>

        </div>
    </div>
    
@endsection

@section('footer-js')
    <script>

// Hapus Data Form Aktifitas
$(document).on('click', '#hapus_form_aktifitas', function(e) {
    event.preventDefault();
    var url = $(this).attr('href');
    Swal.fire({
      title: 'Apakah anda ingin menghapus data ini ?',
      text: "Data ini akan terhapus selamanya!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Iya, Hapus aja!',
      cancelButtonText: 'Jangan Hapus'
    }).then((result) => {
      if (result.value) {
        Swal.fire(
          'Data Terhapus!!',
          'Data berhasil dihapus.',
        )
         window.location.href = url;
      }
    });
});


 $(document).ready(function(){

     // Js Penjumlahan Kolom sub_total
      var table_akt = document.getElementById('table_aktifitas'), sumHsl = 0;
      for( var t = 1; t < table_akt.rows.length; t++ )
      {
          sumHsl = sumHsl + parseInt(table_akt.rows[t].cells[1].innerHTML);
      }
      document.getElementById('total_biaya').value = sumHsl;
    // End of Js Penjumlahan Kolom sub_total
   
   });

    </script>
@endsection