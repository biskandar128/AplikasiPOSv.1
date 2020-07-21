@extends('pages.kasir.master')

@section('title', 'Halaman Return Barang')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Form Return Barang</h1>
        </div>

        <div class="row">

            <!-- Area Chart -->
            <div class="col-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Cari No Transaksi</h6>
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
                                <label>No Transaksi</label>
                                        <div class="input-group mb-2">
                                            <input type="text" name="cari_kode" class="form-control" placeholder="Cari No. Transaksi" aria-label="Search" aria-describedby="basic-addon2" id="cari_barang">
                                            <div class="input-group-append">
                                                    <button name="search" class="btn btn-primary" id="show">
                                                    <i class="fas fa-search fa-sm"></i>
                                                    Cari
                                                    </button>
                                            </div>
                                        </div>

                                    
                                    
                                    

                                {{--  End of Form Barang Masuk  --}}


                    </div>
                    
                </div>
            </div>

        </div>



        <div class="row"  id="form-return">

            <!-- Area Chart -->
            <div class="col-xl-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Form Return Barang</h6>
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
                        
                        <div class="col-lg-12 mb-3">
                            <form action="{{ url('/kasir/form-return-barang') }}" method="post" id="form_return">
                            @csrf

                            <div class="form-group">
                                <label>Tanggal Return</label>
                                <input type="date" class="form-control" id="tgl_return" name="tgl_return">
                            </div>

                            <div class="form-group">
                                    <label for="no_retur">No. Retur</label>
                                    <input type="text" class="form-control" id="no_retur" name="no_retur" value="{{ $code }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama">
                                </div>

                                <div class="form-group">
                                    <label for="alasan">Alasan</label>
                                    <textarea class="form-control" name="alasan" id="alasan" placeholder="Masukkan Alasan"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" name="alamat" id="alamat" placeholder="Masukkan Alamat"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="total_biaya">Total Biaya yang Dikembalikan</label>
                                    <input type="text" class="form-control" name="total_biaya" id="total_biaya" readonly>
                                </div>

                                <button class="btn btn-success btn-icon-split" name="done" value="done" id="btn_submit_return">
                                    <span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                    </span>
                                    <span class="text">Selesai</span>
                                </button>
                            </form>
                                                
                        </div>
                    </div>
                </div>
            </div>


            <!-- Area Chart -->
            <div class="col-xl-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">List Barang Pembelian</h6>
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
                        <div class="col-lg-12 mb-3">
                                                

                            <table class="table table-bordered" id="table_return" style="font-size:14px">
                                <thead align="center">
                                    <tr>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Barang</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>


                                                
                        </div>
                    </div>                    
                </div>
            </div>
            

        
        </div>
    </div>
@endsection

@section('footer-js')
    <script>

$(document).on('click', '#btn_submit_return', function(){
        var return_date = $('#tgl_return').val();
            var return_code = $('#no_retur').val();
            var return_name = $('#nama').val();
            var return_reason = $('#alasan').val();
            var return_address = $('#alamat').val();
            var return_total = $('#total_biaya').val();
    
    if(return_date == ''){    
        event.preventDefault();
        Swal.fire({
                icon: 'error',
                title: 'Ooops...',
                text: 'Data tanggal tidak boleh kosong!'
        });
    }else if(return_code == ''){
        event.preventDefault();
        Swal.fire({
                icon: 'error',
                title: 'Ooops...',
                text: 'Data kode return tidak boleh kosong!'
        });
    }else if(return_name == ''){
        event.preventDefault();
        Swal.fire({
                icon: 'error',
                title: 'Ooops...',
                text: 'Data nama tidak boleh kosong!'
        });
    }else if(return_reason == ''){
        event.preventDefault();
        Swal.fire({
                icon: 'error',
                title: 'Ooops...',
                text: 'Data alasan return tidak boleh kosong!'
        });
    }else if(return_address == ''){
        event.preventDefault();
        Swal.fire({
                icon: 'error',
                title: 'Ooops...',
                text: 'Data alamat return tidak boleh kosong!'
        });
    }else if(return_total == ''){
        event.preventDefault();
        Swal.fire({
                icon: 'error',
                title: 'Ooops...',
                text: 'Data tidak boleh kosong!'
        });
    }
    else{
        $('#form_return').submit();
    }
});
      

 // Hide and Show Form Return Barang
  $(document).ready(function(){

	$("#form-return").hide();

    
    $('#cari_barang').on('keyup', function(){
            
    $value = $(this).val();
    $.ajax({
        type: 'get',
        url: '/kasir/form-return-barang/cari',
        data: {'cari_barang':$value},
        success:function(data){
          $('tbody').html(data);
        }
      });

        $("#show").click(function(){
          document.getElementById('cari_barang').readOnly = true;
          $("#form-return").show();   
        });              
        
        // Hapus data tanpa reload page
        $(document).on("click", "#return" , function() {
            var return_val = $(this).data('id');
            var return_id = $('#return').val();
            var return_date = $('#tgl_return').val();
            var return_code = $('#no_retur').val();
            var return_name = $('#nama').val();
            var return_reason = $('#alasan').val();
            var return_address = $('#alamat').val();

            if(return_date == '')
            {
              Swal.fire({
                icon: 'error',
                title: 'Ooops...',
                text: 'Tanggal tidak boleh kosong!'
              });
            }
            else if(return_code == '')
            {
              Swal.fire({
                icon: 'error',
                title: 'Ooops...',
                text: 'Nomor Return tidak boleh kosong!'
              });
            }
            else if( return_name == '' )
            {
              Swal.fire({
                icon: 'error',
                title: 'Ooops...',
                text: 'Kolom nama tidak boleh kosong!'
              });
            }
            else if( return_reason == '' )
            {
              Swal.fire({
                icon: 'error',
                title: 'Ooops...',
                text: 'Kolom alasan return tidak boleh kosong!'
              });
            }
            else if( return_address == '' )
            {
              Swal.fire({
                icon: 'error',
                title: 'Ooops...',
                text: 'Kolom alamat return tidak boleh kosong!'
              });
            }
            else{   
                var el = $(this).closest('tr');
                $.ajax({
                  url: 'form-return-barang/return-barang/'+return_id+'/'+return_val+'/'+return_date+'/'+return_code,
                  type: 'get',
                  success: function(response){
                  $(el).remove();
                 }
               });
            }

         });      

    });   


});

function hitung_cost(id){
      var return_date = $('#tgl_return').val();
      var return_code = $('#no_retur').val();
      var return_name = $('#nama').val();
      var return_reason = $('#alasan').val();
      var return_address = $('#alamat').val();

      if(return_date && return_code &&  return_name && return_reason && return_address != '')
      {             
          var number = document.getElementById('total_biaya').value | 0;
          var total = parseInt(number) + id;
          document.getElementById('total_biaya').value = total;       
          
      }                
  }   
    </script>
@endsection