@extends('pages.admin.master')

@section('title', 'Detail Barang dalam Gudang')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Data Barang dalam Gudang</h1>
        </div>

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
                        <input type="text" class="form-control w-25 float-right" id="cari_laporan" placeholder="Cari disini...">
                    </div>
                    
                    
                    <!-- Card Body -->
                    <div class="card-body">
                    
                               <div class="table-responsive text-nowrap">
                                <!--Table-->
                                
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead align="center">
                                        <tr>
                                            <th>Nomor</th>
                                            <th class="sorting" data-sorting_type="asc" data-column_name="tgl" style="cursor: pointer">Tanggal <span id="tgl_icon"></span>
                                            <th class="sorting" data-sorting_type="asc" data-column_name="nama_barang" style="cursor: pointer">Nama Barang <span id="nama_barang_icon"></span>
                                            <th class="sorting" data-sorting_type="asc" data-column_name="harga_beli" style="cursor: pointer">Harga Supplier <span id="harga_beli_icon"></span>
                                            <th class="sorting" data-sorting_type="asc" data-column_name="stok_awal" style="cursor: pointer">Stok Awal <span id="stok_awal_icon"></span>
                                            <th class="sorting" data-sorting_type="asc" data-column_name="stok_masuk" style="cursor: pointer">Stok Masuk <span id="stok_masuk_icon"></span>
                                            <th class="sorting" data-sorting_type="asc" data-column_name="stok_keluar" style="cursor: pointer">Stok Keluar <span id="stok_keluar_icon"></span>
                                            <th class="sorting" data-sorting_type="asc" data-column_name="stok_akhir" style="cursor: pointer">Stok Akhir <span id="stok_akhir_icon"></span>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        @include('pages.admin.laporan.laporan-barang-masuk.pagination_data')

                                    </tbody>
                                </table>
                               
                                    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                                    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                                    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
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
 // Js Search and Sort Laporan Stok Barang
  
 //$(document).ready(function() {
   // $('#dataTable').DataTable();
//} ); 

$(document).ready(function(){

    function clear_icon()
    {
      $('#tgl_icon').html('');
      $('#nama_barang_icon').html('');
      $('#harga_beli_icon').html('');
      $('#stok_awal_icon').html('');
      $('#stok_masuk_icon').html('');
      $('#stok_keluar_icon').html('');
      $('#stok_akhir_icon').html('');
    }

    function fetch_data(page, sort_type, sort_by, query)
    {
      $.ajax({
      url:"/admin/laporan-stok/cari-laporan?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type+"&query="+query,
      success:function(data)
        {
          $('tbody').html('');
          $('tbody').html(data);
        }
      })
    }

    $(document).on('keyup', '#cari_laporan', function(){
      var query = $('#cari_laporan').val();
      var column_name = $('#hidden_column_name').val();
      var sort_type = $('#hidden_sort_type').val();
      var page = $('#hidden_page').val();
      fetch_data(page, sort_type, column_name, query);
    });

    $(document).on('click', '.sorting', function(){
      var column_name = $(this).data('column_name');
      var order_type = $(this).data('sorting_type');
      var reverse_order = '';
      if(order_type == 'asc')
      {
      $(this).data('sorting_type', 'desc');
      reverse_order = 'desc';
      clear_icon();
      $('#'+column_name+'_icon').html('<span class="fa fa-arrow-down"></span>');
      }
      if(order_type == 'desc')
      {
      $(this).data('sorting_type', 'asc');
      reverse_order = 'asc';
      clear_icon();
      $('#'+column_name+'_icon').html('<span class="fa fa-arrow-up"></span>');
      }
      $('#hidden_column_name').val(column_name);
      $('#hidden_sort_type').val(reverse_order);
      var page = $('#hidden_page').val();
      var query = $('#cari_laporan').val();
      fetch_data(page, reverse_order, column_name, query);
    });

        $(document).on('click', '.pagination a', function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        $('#hidden_page').val(page);
        var column_name = $('#hidden_column_name').val();
        var sort_type = $('#hidden_sort_type').val();

        var query = $('#cari_laporan').val();

        
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        fetch_data(page, sort_type, column_name, query);
      });

    });

  // End of Js Search and Sort Laporan Stok Barang

</script>
    
@endsection