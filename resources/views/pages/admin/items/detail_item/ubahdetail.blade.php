@extends('pages.admin.master')

@section('title', 'Tambah Data Barang')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Ubah Data Barang dalam Gudang</h1>
            <a href="{{ url('/admin/detail_barang') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><span class="fa fa-chevron-left text-white-150"></span> Kembali</a>
        </div>

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Ubah Data Barang dalam Gudang</h6>
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
                                <form action="{{ url('/admin/detail_barang/'.$details->id) }}" method="post">
                                    @method('patch')
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="kd_barang">Kode Barang</label>
                                        <input type="text" id="kd_barang" class="form-control @error('kd_barang') is-invalid @enderror" name="kd_barang" placeholder="Masukkan Kode Barang" value={{ $details->kd_barang }} readonly>
                                        @error('kd_barang')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="nama_barang">Nama Barang</label>
                                        <input type="text" id="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" placeholder="Masukkan Nama Barang" value="{{ $details->nama_barang }}">
                                        @error('nama_barang')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="kd_jenis">Kode Jenis Barang</label>
                                        <select id="kd_jenis" class="form-control @error('kd_jenis') is-invalid @enderror" name="kd_jenis">
                                        </select>
                                        @error('kd_jenis')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="jenis_barang">Jenis Barang</label>
                                        <div id="jenis_barang">
                                        <input type="text" class="form-control" placeholder="Masukkan Jenis Barang..." readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="berat">Berat Barang (gr)</label>
                                        <input type="text" class="form-control @error('berat') is-invalid @enderror" id="berat" name="berat" placeholder="Masukkan Berat Barang" value={{ $details->berat }}>
                                        @error('berat')
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
    $('#kd_jenis').select2({
        placeholder: 'Cari kode jenis barang',
        ajax: {
          url: '/admin/cari-jenis-barang',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.kd_jenis,
                        id: item.kd_jenis
                    }
                })
            };
          },
          cache: true
        }
      });

      $(document).ready(function(){
          $('#kd_jenis').on('change', function (e){
              var id = e.target.value;
              $.get('{{ url('/admin/jenis-barang-select') }}/' + id, function(data){
                  console.log(id);
                  console.log(data);


                  $('#jenis_barang').empty();
                  $.each(data, function(index, element){
                      $('#jenis_barang').append("<input type='text' class='form-control' value='"+ element.jenis_barang +"' readonly>");
                  });
              });
          });
      });
</script>
    
@endsection