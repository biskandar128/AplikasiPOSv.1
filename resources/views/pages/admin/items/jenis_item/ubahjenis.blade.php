@extends('pages.admin.master')

@section('title', 'Ubah Data Jenis Barang')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Ubah Jenis Data Barang dalam Gudang</h1>
            <a href="{{ url('/admin/jenis_barang') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><span class="fa fa-chevron-left text-white-150"></span> Kembali</a>
        </div>

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Ubah Jenis Data Barang dalam Gudang</h6>
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
                                <form action="{{ url('/admin/jenis_barang/' . $jenis_item->id) }}" method="post">
                                    @method('patch')
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="kd_jenis">Kode Jenis Barang</label>
                                        <input type="text" id="kd_jenis" class="form-control" name="kd_jenis" placeholder="Masukkan Kode Jenis Barang" value="{{ $jenis_item->kd_jenis }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="jenis_barang">Nama Jenis Barang</label>
                                        <input type="text" id="jenis_barang" class="form-control @error('jenis_barang') is-invalid @enderror" name="jenis_barang" placeholder="Masukkan Nama Jenis Barang" value="{{ $jenis_item->jenis_barang }}">
                                        @error('jenis_barang')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <button class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                        <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text">Simpan Data</span>
                                    </button>
                                </form>
                                {{--  End of Form Barang Masuk  --}}


                    </div>
                    
                </div>
            </div>

        </div>
    </div>
@endsection