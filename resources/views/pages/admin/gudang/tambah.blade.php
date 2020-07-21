@extends('pages.admin.master')

@section('title', 'Tambah Data Barang')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Data Stok Barang dalam Gudang</h1>
            <a href="{{ url('/admin/gudang') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><span class="fa fa-chevron-left text-white-150"></span> Kembali</a>
        </div>

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data Stok Barang dalam Gudang</h6>
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
                                <form action="{{ url('/admin/gudang') }}" method="post">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="kd_gudang">Kode Gudang</label>
                                        <input type="text" id="kd_gudang" class="form-control @error('kd_gudang') is-invalid @enderror" name="kd_gudang" placeholder="Masukkan Kode Gudang" value="{{ $code }}" readonly>
                                        @error('kd_gudang')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="kd_user_supplier_add">Kode Pemasok</label>
                                        <select  class="form-control @error('kd_supplier') is-invalid @enderror" id="kd_user_supplier_add" name="kd_supplier">
                                        </select>
                                        @error('kd_supplier')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="kd_barang">Kode Barang</label>
                                        <select id="kd_barang" class="form-control @error('kd_barang') is-invalid @enderror" name="kd_barang">
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="harga_pemasok">Harga Pemasok (Rp)</label>
                                        <input type="number" class="form-control @error('harga_supplier') is-invalid @enderror" id="harga_pemasok" name="harga_supplier" placeholder="Masukkan Berat Barang" value="{{ old('harga_supplier') }}">
                                        @error('harga_supplier')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="harga_jual">Harga Jual (Rp)</label>
                                        <input type="number" id="harga_jual" class="form-control @error('harga_jual') is-invalid @enderror" name="harga_jual" placeholder="Masukkan Kode Gudang" value="{{ old('harga_jual') }}">
                                        @error('harga_jual')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="stok">Stok Barang</label>
                                        <input type="number" id="stok" class="form-control @error('stok') is-invalid @enderror" name="stok" placeholder="Masukkan Kode Gudang" value="{{ old('stok') }}">
                                        <input type="hidden" name="stok_out" value="0">
                                        @error('stok')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="status_harga">Status Harga</label>
                                        <select id="status_harga" class="form-control @error('status_harga') is-invalid @enderror" name="status_harga">
                                            <option disabled selected>-- Masukkan keterangan harga --</option>
                                            <option value="Harga Tidak Aktif" {{ old('status_harga') == 'Harga Tidak Aktif' ? 'selected' : '' }}>Harga Tidak Aktif</option>
                                            <option value="Harga Aktif" {{ old('status_harga') == 'Harga Aktif' ? 'selected' : '' }}>Harga Aktif</option>
                                        </select>
                                        @error('status_harga')
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

@section('footer-js')
  <script src="{{ asset('backend/js/select2.min.js') }}"></script>
    <script>
    $('#kd_user_supplier_add').select2({
        placeholder: 'Cari kode pemasok',
        ajax: {
          url: '/admin/cari-supplier',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.kd_supplier,
                        id: item.kd_supplier
                    }
                })
            };
          },
          cache: true
        }
      });

      $('#kd_barang').select2({
        placeholder: 'Cari kode barang',
        ajax: {
          url: '/cari-barang',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.kd_barang,
                        id: item.kd_barang
                    }
                })
            };
          },
          cache: true
        }
      });
    </script>
@endsection