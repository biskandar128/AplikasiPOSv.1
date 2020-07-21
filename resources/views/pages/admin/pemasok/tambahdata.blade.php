@extends('pages.admin.master')

@section('title', 'Tambah Data Barang Masuk')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Data Barang Masuk</h1>
            <a href="{{ url('/admin/pemasok') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><span class="fa fa-chevron-left text-white-150"></span> Kembali</a>
        </div>

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data Barang Masuk</h6>
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
                                <form action="{{ url('/admin/pemasok') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="kd_pemasok">Kode Supplier</label>
                                        <select type="text" class="form-control @error('kd_supplier') is-invalid @enderror" id="kd_user_supplier_add" name="kd_supplier" placeholder="Masukkan Kode Pemasok..." value="{{ old('kd_supplier') }}"></select>
                                        @error('kd_supplier')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="nama_pemasok">Nama Supplier</label>
                                        <div id="nama_pemasok">
                                        <input type="text" class="form-control @error('nama_supplier') is-invalid @enderror" name="nama_supplier" placeholder="Nama Supplier..." readonly value="{{ old('nama_supplier') }}">
                                        </div>
                                        @error('nama_supplier')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="kd_barang_supplier">Kode Barang</label>
                                        <select id="kd_barang_supplier" style="cursor:pointer" class="form-control @error('kd_barang') is-invalid @enderror" name="kd_barang" value="{{ old('kd_barang') }}">
                                        </select>
                                        @error('kd_barang')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="nama_barang">Nama Barang</label>
                                        <div id="nama_barang">
                                        <input type="text" class="form-control" readonly placeholder="Nama Barang...">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="qty">Qty</label>
                                        <input type="number" class="form-control @error('qty') is-invalid @enderror" id="qty" name="qty" placeholder="Masukan Qty Barang..." value="{{ old('qty') }}">
                                        @error('qty')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="harga_beli">Harga Pemasok</label>
                                        <input type="number" class="form-control @error('harga_beli') is-invalid @enderror" id="harga_beli" name="harga_beli" placeholder="Masukan Harga Pembelian..." value="{{ old('harga_beli') }}">
                                        @error('harga_beli')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl">Tanggal Barang Datang</label>
                                        <input type="date" class="form-control @error('tgl_barang_datang') is-invalid @enderror" id="tgl" name="tgl_barang_datang" placeholder="" value="{{ old('tgl_barang_datang') }}">
                                        @error('tgl_barang_datang')
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
     // Js Search Autocomplete Supplier
    $('#kd_user_supplier_add').select2({
        placeholder: 'Cari kode supplier',
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
      $(document).ready(function(){
          $('#kd_user_supplier_add').on('change', function(e){
            var id = e.target.value;
            $.get('{{ url('/admin/supplier-select') }}/'+id, function(data){
              console.log(id);
              console.log(data);

              $('#nama_pemasok').empty();
              $.each(data, function(index, element){
                $('#nama_pemasok').append("<input type='text' class='form-control' name='nama_supplier' value='"+element.nama_supplier+"' readonly>");
              });

              
            });
          });
      });
      // End Js Search Autocomplete Supplier

      // Js Search Autocomplete Barang Supplier
      $('#kd_barang_supplier').select2({
          placeholder: 'Cari kode barang',
          ajax: {
              url: '/admin/cari-barang',
              dataType: 'json',
              delay: 250,
              processResults: function(data){
                  return{
                      results: $.map(data, function(barang){
                          return{
                              text: barang.kd_barang,
                              id: barang.kd_barang
                          }
                      })
                  };
              },
              cache: true
          }
      });

      $(document).ready(function(){
          $('#kd_barang_supplier').on('change', function(e){
              var id = e.target.value;
            $.get('{{ url('/admin/barang-select') }}/'+id, function(data){
                  console.log(id);
                  console.log(data);

                  $('#nama_barang').empty();
                  $.each(data, function(index, element){
                      $('#nama_barang').append("<input type=text class='form-control' value='"+element.nama_barang+"' readonly>");
                  });
                  
              });
          });
      });
      // End Js Search Autocomplete Barang Supplier


</script>

@endsection