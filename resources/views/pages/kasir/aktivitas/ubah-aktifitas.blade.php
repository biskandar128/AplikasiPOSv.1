@extends('pages.kasir.master')

@section('title', 'Aktivitas Perusahaan')

@section('content')

<!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Ubah Kegiatan Aktifitas Perusahaan</h1>
            <a href="{{ url('tambah-aktifitas') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><span class="fa fa-chevron-left text-white-150"></span> Kembali</a>
        </div>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Ubah Data Aktifitas</h6>
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
                                <form action="{{ url('/kasir/form-aktifitas-update/'. $details->kd_aktivitas . '/' . $details->aktifitas) }}" method="post">
                                    @method('patch')
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="kd_aktifitas">Kode Aktifitas</label>
                                        <input type="text" id="kd_aktifitas" class="form-control @error('kd_aktifitas') is-invalid @enderror" name="kd_aktifitas" value="{{ $details->kd_aktivitas }}" readonly>
                                        @error('kd_aktifitas')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_aktifitas">Tanggal Aktifitas</label>
                                        <input type="date" id="tgl_aktifitas" class="form-control @error('tgl_aktifitas') is-invalid @enderror" name="tgl_aktifitas" value="{{ $details->tgl_aktifitas }}">
                                        @error('tgl_aktifitas')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="nama_aktifitas">Nama Aktifitas</label>
                                        <input type="text" id="nama_aktifitas" class="form-control @error('nama_aktifitas') is-invalid @enderror" name="nama_aktifitas" placeholder="Masukkan Kegiatan" value="{{ $details->aktifitas }}">
                                        @error('nama_aktifitas')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="biaya_keluar">Biaya dikeluarkan</label>
                                        <input type="text" id="biaya_keluar" class="form-control @error('biaya_keluar') is-invalid @enderror" name="biaya_keluar" value="{{ $details->total_biaya }}">
                                        @error('biaya_keluar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <button class="btn btn-success btn-icon-split" name="btn_tambah">
                                        <span class="icon text-white-50">
                                        <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text">Ubah Data</span>
                                    </button>
                                </form>
                                {{--  End of Form Barang Masuk  --}}


                    </div>
                    
                </div>
            </div>

        </div>
    </div>
    
@endsection