@extends('pages.admin.master')

@section('title', 'Halaman Return Barang')

@section('content')
<!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Daftar Return Barang</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Info Daftar Return Barang</h6>
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

                        <div class="mt-3 mr-3 mb-3">
                            <input type="text" class="form-control w-25 float-right" id="cari_return" placeholder="Cari disini...">
                        </div>

                    <div class="card-body">
                        
                        

                               <div class="table-responsive text-nowrap">
                                    <!--Table-->
                                    <table class="table table-bordered">

                                    <!--Table head-->
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                        <th class="sorting" data-sorting_type_return="asc" data-column_name_return="kd_return" style="cursor: pointer">Kode Return <span id="kd_return_icon"></span>
                                        <th class="sorting" data-sorting_type_return="asc" data-column_name_return="tgl_return" style="cursor: pointer">Tanggal Return <span id="tgl_return_icon"></span>
                                        <th class="sorting" data-sorting_type_return="asc" data-column_name_return="nama" style="cursor: pointer">Nama <span id="nama_icon"></span>
                                        <th class="sorting" data-sorting_type_return="asc" data-column_name_return="alasan_return" style="cursor: pointer">Alasan Return <span id="alasan_return_icon"></span>
                                        <th class="sorting" data-sorting_type_return="asc" data-column_name_return="alamat_return" style="cursor: pointer">Alamat Return <span id="alamat_return_icon"></span>
                                        <th class="sorting" data-sorting_type_return="asc" data-column_name_return="total" style="cursor: pointer">Biaya Dikembalikan <span id="total_icon"></span>
                                        <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <!--Table head-->

                                    <!--Table body-->
                                    <tbody>

                                    @include('pages.admin.return-barang.pagination_data')
                                        
                                    </tbody>
                                    <!--Table body-->

                                    <input type="hidden" name="hidden_page_return" id="hidden_page_return" value="1" />
                                    <input type="hidden" name="hidden_column_name_return" id="hidden_column_name_return" value="id" />
                                    <input type="hidden" name="hidden_sort_type_return" id="hidden_sort_type_return" value="asc" />


                                    </table>
                                    <!--Table-->
                            </div>
                        <!--Section: Live preview-->


                    </div>
                    
                </div>
            </div>

        </div>
    </div>
@endsection

@section('footer-js')
    <script>
// Search and Sort Data Return
$(document).ready(function(){

  function clear_icon_return(){
    $('#kd_return_icon').html('');
    $('#tgl_return_icon').html('');
    $('#nama_icon').html('');
    $('#alasan_return_icon').html('');
    $('alamat_return_icon').html('');
    $('total_icon').html('');
  }

  function cari_return(page, sort_type, sort_by, query)
  {
    $.ajax({
      url:'/admin/detail-return-barang/cari-return?page='+page+'&sortby='+sort_by+'&sorttype='+sort_type+'&query='+query,
      success:function(data)
      {
        $('tbody').html('');
        $('tbody').html(data);
      }
    })
  }

  $(document).on('keyup', '#cari_return', function(){
    var query = $('#cari_return').val();
    var column_name = $('#hidden_column_name_return').val();
    var sort_type = $('#hidden_sort_type_return').val();
    var page = $('#hidden_page_return').val();
    cari_return(page, sort_type, column_name, query);
  });

  $(document).on('click', '.sorting', function(){
    var column_name = $(this).data('column_name_return');
    var order_type = $(this).data('sorting_type_return');
    var reverse_order = '';
    
    if(order_type == 'asc')
    {
      $(this).data('sorting_type_return', 'desc');
      reverse_order = 'desc';
      clear_icon_return();
      $('#'+column_name+'_icon').html('<span class="fa fa-arrow-down"></span>');
    }

    if(order_type == 'desc')
    {
      $(this).data('sorting_type_return', 'asc');
      reverse_order = 'asc';
      clear_icon_return();
      $('#'+column_name+'_icon').html('<span class="fa fa-arrow-up"></span>');
    }

    $('#hidden_column_name_return').val(column_name);
    $('#hidden_sort_type_return').val(reverse_order);
    var page = $('#hidden_page_return').val();
    var query = $('#cari_return').val();
    cari_return(page, reverse_order, column_name, query);
  });

  $(document).on('click', '.pagination a', function(event){
    event.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    $('#hidden_page_return').val(page);
    var column_name = $('#hidden_column_name_return').val();
    var sort_type = $('#hidden_sort_type_return').val();
    var query = $('#cari_return').val();

    $('li').removeClass('active');
    $(this).parent('li').addClass('active');
    cari_return(page, sort_type, column_name, query);
  });

});



// Hapus Data Return
$(document).on('click', '#hapus_return', function(e) {
    event.preventDefault();
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
          'Data Terhapus!',
          'Data berhasil dihapus.',
        )
        this.submit();
      }
    });
});

    </script>
@endsection