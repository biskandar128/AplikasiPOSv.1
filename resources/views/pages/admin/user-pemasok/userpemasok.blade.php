@extends('pages.admin.master')

@section('title', 'Daftar Supplier')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Daftar Supplier</h1>
            <a href="{{ url('/admin/info-pemasok/create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><span class="fas fa-plus-square fa-medium text-white-50"></span> Tambah Data</a>
        </div>
        

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif


        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Info Daftar Supplier</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Print Data</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                    </div>
                    <!-- Card Body -->

                    <div class="mt-3 mr-3">
                        <input type="text" class="form-control w-25 float-right" id="cari_upemasok" placeholder="Cari disini...">
                    </div>
                    
                    <div class="card-body">
                        

                               <div class="table-responsive text-nowrap">
                                    <!--Table-->
                                    <table class="table table-bordered">

                                    <!--Table head-->
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                        <th class="sorting" data-sorting_type_upemasok="asc" data-column_name_upemasok="kd_supplier" style="cursor: pointer">Kode Supplier <span id="kd_supplier_icon"></span>
                                        <th class="sorting" data-sorting_type_upemasok="asc" data-column_name_upemasok="nama_supplier" style="cursor: pointer">Nama Supplier <span id="nama_supplier_icon"></span>
                                        <th class="sorting" data-sorting_type_upemasok="asc" data-column_name_upemasok="email" style="cursor: pointer">Email <span id="email_icon"></span>
                                        <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <!--Table head-->

                                    <!--Table body-->
                                    <tbody>

                                    @include('pages.admin.user-pemasok.pagination_data')
                                        
                                    </tbody>
                                    <!--Table body-->


                                    </table>
                                    <!--Table-->

                                <input type="hidden" name="hidden_page_upemasok" id="hidden_page_upemasok" value="1" />
                                <input type="hidden" name="hidden_column_name_upemasok" id="hidden_column_name_upemasok" value="id" />
                                <input type="hidden" name="hidden_sort_type_upemasok" id="hidden_sort_type_upemasok" value="asc" />


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
// Search and Sort Data User Supplier
$(document).ready(function(){

  function clear_icon_upemasok(){
    $('#kd_supplier_icon').html('');
    $('#nama_supplier_icon').html('');
    $('#email_icon').html('');
  }

  function cari_upemasok(page, sort_type, sort_by, query)
  {
    $.ajax({
      url:'info-pemasok/cari-pemasok?page='+page+'&sortby='+sort_by+'&sorttype='+sort_type+'&query='+query,
      success:function(data)
      {
        $('tbody').html('');
        $('tbody').html(data);
      }
    })
  }

  $(document).on('keyup', '#cari_upemasok', function(){
    var query = $('#cari_upemasok').val();
    var column_name = $('#hidden_column_name_upemasok').val();
    var sort_type = $('#hidden_sort_type_upemasok').val();
    var page = $('#hidden_page_upemasok').val();
    cari_upemasok(page, sort_type, column_name, query);
  });

  $(document).on('click', '.sorting', function(){
    var column_name = $(this).data('column_name_upemasok');
    var order_type = $(this).data('sorting_type_upemasok');
    var reverse_order = '';
    
    if(order_type == 'asc')
    {
      $(this).data('sorting_type_upemasok', 'desc');
      reverse_order = 'desc';
      clear_icon_upemasok();
      $('#'+column_name+'_icon').html('<span class="fa fa-arrow-down"></span>');
    }

    if(order_type == 'desc')
    {
      $(this).data('sorting_type_upemasok', 'asc');
      reverse_order = 'asc';
      clear_icon_upemasok();
      $('#'+column_name+'_icon').html('<span class="fa fa-arrow-up"></span>');
    }

    $('#hidden_column_name_upemasok').val(column_name);
    $('#hidden_sort_type_upemasok').val(reverse_order);
    var page = $('#hidden_page_upemasok').val();
    var query = $('#cari_upemasok').val();
    cari_upemasok(page, reverse_order, column_name, query);
  });

  $(document).on('click', '.pagination a', function(event){
    event.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    $('#hidden_page_upemasok').val(page);
    var column_name = $('#hidden_column_name_upemasok').val();
    var sort_type = $('#hidden_sort_type_upemasok').val();
    var query = $('#cari_upemasok').val();

    $('li').removeClass('active');
    $(this).parent('li').addClass('active');
    cari_upemasok(page, sort_type, column_name, query);
  });

});

// Hapus Data User Supplier
$(document).on('click', '#hapus_user_supplier', function(e) {
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