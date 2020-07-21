@extends('pages.admin.master')

@section('title', 'Transaksi Barang')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif


        <div class="row">
            <div class="col-12 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Form Transaksi</h6>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                                {{--  Form Barang Masuk  --}}
                                
                                <form action="{{ url('/admin/transaksi') }}" method="post" id="form_transaksi" name="form_transaksi" onclick="return validateForm()">
                                @csrf  
                                    <div class="row">
                                        
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="tgl">Tanggal Transaksi</label>
                                                <input type="text" class="form-control @error('tgl_transaksi') is-invalid @enderror" id="tgl" name="tgl_transaksi" value="{{date('Y-m-d')}}" readonly>
                                                @error('tgl_transaksi')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="kd_transaksi">Kode Transaksi</label>
                                                <input type="text" class="form-control @error('kd_transaksi') is-invalid @enderror" id="kd_transaksi" name="kd_transaksi" value="{{ $code }}" readonly>
                                                @error('kd_transaksi')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">

                                        </div>
                                        
                                        <div class="col-6">
                                            
                                            <div class="form-group">
                                                {{--  {!! Form::label('kd_barang', 'Pilih Kode Barang' ) !!}
                                                {!! Form::select('kd_barang', $kd_barang, null, array('id' => 'kd_barang', 'class' => 'form-control') ) !!}  --}}                                        
                                                <label for="kd_barang">Kode Barang</label>                                                
                                                {{-- <select id="kd_barang" class="form-control" name="kd_barang">
                                                        <option>-- Pilih Kode Barang --</option>
                                                    @foreach ($kd_barang as $item)
                                                        <option value="{{ $item->kd_barang }}">{{ $item->kd_barang }} | Stok : {{ $item->stok }}</option>
                                                    @endforeach
                                                </select> --}}

                                                {{-- <input type="text" name="kd_barang" id="kd_barang" placeholder="Kode Barang" class="form-control"> --}}

                                                {{-- Form untuk search autocomplete --}}
                                                <select class="form-control @error('kd_barang') is-invalid @enderror" id="kd_barang_transaksi" name="kd_barang"></select>
                                                @error('kd_barang')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Nama Barang</label>
                                                <div id="nama_barang">
                                                    <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" value="" readonly>
                                                </div>
                                                @error('nama_barang')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Harga Barang</label>
                                                <div id="harga">
                                                    <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga_barang" name="harga" onKeyUp="sum();" readonly>
                                                </div>
                                                @error('harga')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="qty">Qty</label>
                                                <input type="number" class="form-control @error('qty') is-invalid @enderror" id="qty" name="qty" onKeyUp="sum();" placeholder="Masukan Qty Barang...">
                                                @error('qty')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="sub_total">Sub Total</label>
                                                <input type="text" class="form-control @error('sub_total') is-invalid @enderror" id="sub_total" name="sub_total" placeholder="" readonly>
                                                @error('sub_total')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <button class="btn btn-primary btn-icon-split" name="transaksi" value="transaksi">
                                                <span class="icon text-white-50">
                                                <i class="fas fa-plus"></i>
                                                </span>
                                                <span class="text">Tambah Barang</span>
                                            </button>

                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                    <label for="total">Total (Rp)</label>
                                                    <input type="number" class="form-control @error('total') is-invalid @enderror" id="total" onKeyUp="sum();" name="total" readonly value={{ old('total') }}>
                                                    @error('total')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                            </div>

                                            <div class="form-group">
                                                    <label for="bayar">Bayar (Rp)</label>
                                                    <input type="number" class="form-control @error('bayar') is-invalid @enderror" id="bayar" name="bayar" onKeyUp="sum();">
                                                    @error('bayar')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                            </div>

                                            <div class="form-group">
                                                    <label for="kembali">Kembali (Rp)</label>
                                                    <input type="number" class="form-control @error('kembali') is-invalid @enderror" id="kembali" name="kembali" value="0" readonly>
                                                    @error('kembali')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                            
                                        </div>
                                        
                                    </div>

                                    <div class="mb-5"></div>


                                            
                                  {{--  End of Form Barang Masuk  --}}
                    </div>
                    
                </div>

                
            </div>

            <div class="col-12 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Barang</h6>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                                <!--Table-->
                                <table class="table table-striped" id="table_transaksi" style="font-size:0.9rem;">

                                    <!--Table head-->
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                        <th>Nama Barang</th>
                                        <th>Kode Barang</th>
                                        <th>Harga Barang</th>
                                        <th>Qty</th>
                                        <th>Sub Total</th>
                                        <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <!--Table head-->

                                    <!--Table body-->
                                    <tbody>
                                    @foreach ($transaksis as $transaksi)
                                        <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $transaksi->nama_barang }}</td>
                                        <td>{{ $transaksi->kd_barang }}</td>
                                        <td>{{ $transaksi->harga }}</td>
                                        <td>{{ $transaksi->qty  }}</td>
                                        <td>{{ $transaksi->sub_total }}</td>
                                        <td>
                                            <div class="row">
                                                
                                            <!-- <form action="{{-- url('pemasok/' . $supplier->id) --}}" method="post"> -->
                                                {{--  @method('delete')  --}}
                                                {{--  @csrf  --}}
                                                
                                                <a href="transaksi-delete/{{ $transaksi->id }}" class="btn btn-danger btn-md" title="Hapus Data" id="hapus_form_transaksi">
                                                    <span class="icon text-white-150">
                                                    <i class="fas fa-trash fa-md"></i>
                                                    </span>
                                                </a>
                                                <!-- </form> -->
                                                <div class="ml-1"></div>
                                                <a href="transaksi-update/{{ $transaksi->id }}/update" class="btn btn-primary" title="Ubah Data">
                                                    <span class="icon text-white-150">
                                                    <i class="fa fa-edit"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        </td>
                                        </tr>
                                        
                                    @endforeach
                                        
                                    </tbody>
                                    <!--Table body-->


                                </table>
                                
                                <button class="btn btn-success btn-icon-split mb-5 mt-3" name="transaksi_detail" value="transaksi_clear" id="bayar_transaksi">
                                    <span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                    </span>
                                    <span class="text">Selesaikan Pembelian</span>
                                </button>
                                <a href="{{ url('/admin/transaksi/cetak') }}" target="blank" class="btn btn-primary btn-icon-split mb-5 mt-3">
                                    <span class="icon text-white-50">
                                        <li class="fa fa-print"></li>
                                    </span>
                                    <span class="text">Cetak</span>
                                </a>
                            </form>
                        </div>
                    </div>
                    
                </div>

                
            </div>
        </div>
    </div>
@endsection

@section('footer-js')

  <script src="{{ asset('backend/js/select2.min.js') }}"></script>
  
    <script>
    // Hapus Data Form Transaksi
$(document).on('click', '#hapus_form_transaksi', function(e) {
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

$(document).ready(function() {
    // Js Search Autocomplete Transaksi
    $('#kd_barang_transaksi').select2({
        placeholder: 'Cari kode barang',
        ajax: {
          url: '/admin/cari',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.kd_gudang,
                        id: item.kd_gudang
                    }
                })
            };
          },
          cache: true
        }
      });
      // End of Js Search Autocomplete Transaksi

   // Js Auto Select
      $(document).ready(function(){
          $('#kd_barang_transaksi').on('change', function(e){
            var id = e.target.value;
            $.get('{{ url('/admin/transaksi-select') }}/'+id, function(data){
              console.log(id);
              console.log(data);

              $('#nama_barang').empty();
              $.each(data, function(index, element){
                $('#nama_barang').append("<input type='text' class=form-control name=nama_barang value='"+element.nama_barang+"' readonly>");
              });

              $('#harga').empty();
              $.each(data, function(index, element){
                $('#harga').append("<input type='text' class=form-control id=harga_barang name=harga value='"+element.harga_jual+"' readonly>");
              });
            });
          });
      });
      // End of Js Auto Select
       });

       $(document).on('click', '#bayar_transaksi', function(){

           var total_harga = $('#total').val();
           var bayar = $('#bayar').val();
           if ( bayar < total_harga ) {
                event.preventDefault();
                Swal.fire({
                        icon: 'error',
                        title: 'Mohon maaf',
                        text: 'Uang anda tidak cukup'
                });
           } else {
                $('#form_transaksi').submit();
           }
       });
       
    </script>
@endsection