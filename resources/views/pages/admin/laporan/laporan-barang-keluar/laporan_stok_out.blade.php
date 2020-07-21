@extends('pages.admin.master')

@section('title', 'Laporan Barang Keluar')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Stok Barang Keluar</h1>
        </div>

        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Info Data Stok Barang Keluar</h6>
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
                        <input type="text" class="form-control w-25 float-right" id="cari_laporan_stok_out" placeholder="Cari disini...">
                    </div>
                    
                    <!-- Card Body -->
                    <div class="card-body">
                        

                               <div class="table-responsive text-nowrap">
                                <!--Table-->
                                <table class="table table-bordered">

                                <!--Table head-->
                                <thead>
                                    <tr align="center">
                                    <th>#</th>
                                    <th class="sorting" data-sorting_type_transaksi="asc" data-column_name_transaksi="tgl_transaksi" style="cursor: pointer">Tanggal <span id="tgl_transaksi_icon"></span>
                                    <th class="sorting" data-sorting_type_transaksi="asc" data-column_name_transaksi="kd_transaksi" style="cursor: pointer">No. Transaksi <span id="kd_transaksi_icon"></span>
                                    <th class="sorting" data-sorting_type_transaksi="asc" data-column_name_transaksi="total_transaksi" style="cursor: pointer">Total <span id="total_transaksi_icon"></span>
                                    </tr>
                                </thead>
                                <!--Table head-->

                                <!--Table body-->
                                <tbody>

                                @include('pages.admin.laporan.laporan-barang-keluar.pagination_data')
                                    
                                </tbody>
                                <!--Table body-->


                                </table>

                                    <input type="hidden" name="hidden_page_stok_out" id="hidden_page_stok_out" value="1" />
                                    <input type="hidden" name="hidden_column_name_stok_out" id="hidden_column_name_stok_out" value="id" />
                                    <input type="hidden" name="hidden_sort_type_stok_out" id="hidden_sort_type_stok_out" value="asc" />

                                <!--Table-->
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

// Search and Sort Data Laporan Stok Out
$(document).ready(function (){
  
  function clear_icon_stok_out()
  {
    $('#tgl_transaksi_icon').html('');
    $('#kd_transaksi_icon').html('');
    $('total_transaksi_icon').html('');
  }

  function cari_stok_out(page, sort_type, sort_by, query)
  {
    $.ajax({
      url: '/admin/laporan-stok-out/cari-transaksi?page='+page+'&sortby='+sort_by+'&sorttype='+sort_type+'&query='+query,
      success:function(data)
      {
        $('tbody').html('');
        $('tbody').html(data);
      }
    })
  }

  $(document).on('keyup', '#cari_laporan_stok_out', function(){
    var query = $('#cari_laporan_stok_out').val();
    var column_name = $('#hidden_column_name_stok_out').val();
    var sort_type = $('#hidden_sort_type_stok_out').val();
    var page = $('#hidden_page_stok_out').val();
    cari_stok_out(page, sort_type, column_name, query);
  });

  $(document).on('click', '.sorting', function(){
      var column_name = $(this).data('column_name_transaksi');
      var order_type = $(this).data('sorting_type_transaksi');
      var reverse_order = '';
      if(order_type == 'asc')
    {
      $(this).data('sorting_type_transaksi', 'desc');
      reverse_order = 'desc';
      clear_icon_stok_out();
      $('#'+column_name+'_icon').html('<span class="fa fa-arrow-down"></span>');
    }
    if(order_type == 'desc')
    {
      $(this).data('sorting_type_transaksi', 'asc');
      reverse_order = 'asc';
      clear_icon_stok_out();
      $('#'+column_name+'_icon').html('<span class="fa fa-arrow-up"></span>');
    }
      $('#hidden_column_name_stok_out').val(column_name);
    $('#hidden_sort_type_stok_out').val(reverse_order);
    var page = $('#hidden_page_stok_out').val();
    var query = $('#cari_laporan_stok_out').val();
      cari_stok_out(page, reverse_order, column_name, query);
    });

  $(document).on('click', '.pagination a', function(event){
    event.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    $('#hidden_page_stok_out').val(page);
    var column_name = $('#hidden_column_name_stok_out').val();
    var sort_type = $('#hidden_sort_type_stok_out').val();
    var query = $('#cari_laporan_stok_out').val();

    $('li').removeClass('active');
    $(this).parent('li').addClass('active');
    cari_stok_out(page, sort_type, column_name, query);
  });


});
</script>
@endsection