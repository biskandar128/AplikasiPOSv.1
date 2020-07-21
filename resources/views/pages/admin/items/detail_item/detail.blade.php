@extends('pages.admin.master')

@section('title', 'Detail Barang')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Data Barang dalam Gudang</h1>
            <a href="{{ url('/admin/detail_barang/create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><span class="fas fa-plus-square fa-medium text-white-50"></span> Tambah Data</a>
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
                    <h6 class="m-0 font-weight-bold text-primary">Info Detail Data Barang dalam Gudang</h6>
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

                    <div class="mt-3 mr-3">
                        <input type="text" class="form-control w-25 float-right" id="cari_masterb" placeholder="Cari disini...">
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        

                               <div class="table-responsive text-nowrap">
                                <!--Table-->
                                <table class="table table-bordered">

                                <!--Table head-->
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th class="sorting" data-sorting_type_masterb="asc" data-column_name_masterb="kd_barang" style="cursor: pointer">Kode Barang <span id="kd_barang_icon"></span>
                                    <th class="sorting" data-sorting_type_masterb="asc" data-column_name_masterb="nama_barang" style="cursor: pointer">Nama Barang <span id="nama_barang_icon"></span>
                                    <th class="sorting" data-sorting_type_masterb="asc" data-column_name_masterb="kd_jb" style="cursor: pointer">Kode Jenis Barang <span id="kd_jb_icon"></span>
                                    <th class="sorting" data-sorting_type_masterb="asc" data-column_name_masterb="bb" style="cursor: pointer">Berat Barang (gr) <span id="bb_icon"></span>
                                    <th>Aksi</th>
                                    </tr>
                                </thead>
                                <!--Table head-->

                                <!--Table body-->
                                <tbody>

                                @include('pages.admin.items.detail_item.pagination_data')
                                    
                                </tbody>
                                <!--Table body-->


                                </table>
                                <!--Table-->

                                <input type="hidden" name="hidden_page_masterb" id="hidden_page_masterb" value="1" />
                                <input type="hidden" name="hidden_column_name_masterb" id="hidden_column_name_masterb" value="id" />
                                <input type="hidden" name="hidden_sort_type_masterb" id="hidden_sort_type_masterb" value="asc" />

                            </div>
                        </section>
                        <!--Section: Live preview-->


                    </div>
                    
                </div>
            </div>

        </div>
    </div>
@endsection

@section('footer-js')
    <script>
    // Search and Sort Data Master Barang
$(document).ready(function(){

  function clear_icon_items(){
    $('#kd_barang_icon').html('');
    $('#nama_barang_icon').html('');
    $('#kd_jb_icon').html('');
    $('#bb_icon').html('');
  }

  function cari_masterb(page, sort_type, sort_by, query)
  {
    $.ajax({
      url:'/admin/detail_barang/cari-master-barang?page='+page+'&sortby='+sort_by+'&sorttype='+sort_type+'&query='+query,
      success:function(data)
      {
        $('tbody').html('');
        $('tbody').html(data);
      }
    })
  }

  $(document).on('keyup', '#cari_masterb', function(){
    var query = $('#cari_masterb').val();
    var column_name = $('#hidden_column_name_masterb').val();
    var sort_type = $('#hidden_sort_type_masterb').val();
    var page = $('#hidden_page_masterb').val();
    cari_masterb(page, sort_type, column_name, query);
  });

  $(document).on('click', '.sorting', function(){
    var column_name = $(this).data('column_name_masterb');
    var order_type = $(this).data('sorting_type_masterb');
    var reverse_order = '';
    
    if(order_type == 'asc')
    {
      $(this).data('sorting_type_masterb', 'desc');
      reverse_order = 'desc';
      clear_icon_items();
      $('#'+column_name+'_icon').html('<span class="fa fa-arrow-down"></span>');
    }

    if(order_type == 'desc')
    {
      $(this).data('sorting_type_masterb', 'asc');
      reverse_order = 'asc';
      clear_icon_items();
      $('#'+column_name+'_icon').html('<span class="fa fa-arrow-up"></span>');
    }

    $('#hidden_column_name_masterb').val(column_name);
    $('#hidden_sort_type_masterb').val(reverse_order);
    var page = $('#hidden_page_masterb').val();
    var query = $('#cari_masterb').val();
    cari_masterb(page, reverse_order, column_name, query);
  });

  $(document).on('click', '.pagination a', function(event){
    event.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    $('#hidden_page_masterb').val(page);
    var column_name = $('#hidden_column_name_masterb').val();
    var sort_type = $('#hidden_sort_type_masterb').val();
    var query = $('#cari_masterb').val();

    $('li').removeClass('active');
    $(this).parent('li').addClass('active');
    cari_masterb(page, sort_type, column_name, query);
  });

});



// Hapus Data Barang
$(document).on('click', '#hapus_item  ', function(e) {
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