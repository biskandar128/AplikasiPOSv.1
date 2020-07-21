@extends('pages.kasir.master')

@section('title', 'Ubah Data Return')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Form Return Barang</h1>
            <a href="{{ url('/kasir/detail-return-barang') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><span class="fa fa-chevron-left text-white-150"></span> Kembali</a>
        </div>

            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Form Ubah Data Return Barang</h6>
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
                                <form action="{{ url('/kasir/detail-return-barang/' . $data->kd_return ) }}" method="post">
                                @method('PATCH')
                                @csrf

                                    <div class="form-group">
                                        <label>Tanggal Return</label>
                                        <input type="date" class="form-control @error('tgl_return') is-invalid @enderror" id="tgl_return" name="tgl_return" value="{{ $data->tgl_return }}" readonly>
                                        @error('tgl_return')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="no_return">No. Retur</label>
                                        <input type="text" class="form-control @error('no_return') is-invalid @enderror" id="no_return" name="no_return" placeholder="Masukkan No Retur" value="{{ $data->kd_return }}" readonly>
                                        @error('no_return')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan Nama" value="{{ $data->nama }}">
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="alasan">Alasan</label>
                                        <textarea class="form-control @error('alasan') is-invalid @enderror" name="alasan" id="alasan" placeholder="Masukkan Alasan">{{ $data->alasan_return }}</textarea>
                                        @error('alasan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" placeholder="Masukkan Alamat">{{ $data->alamat_return }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="total_biaya">Total Biaya yang Dikembalikan</label>
                                        <input type="text" class="form-control" name="total_biaya" id="total_biaya" value="{{ $data->total }}" readonly>
                                    </div>

                                    <button class="btn btn-success btn-icon-split">
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
                        <h6 class="m-0 font-weight-bold text-primary">List Barang Dikembalikan</h6>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($returns as $return)
                                        <tr>
                                            <td>{{ $return->kd_barang }}</td>
                                            <td>{{ $return->nama_barang }}</td>
                                            <td>{{ $return->harga_jual }}</td>
                                            <td>{{ $return->qty }}</td>
                                            <td>{{ $return->sub_total }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>


                                                    
                            </div>
                        </div>                    
                    </div>
                </div>
                

            
            </div>
    
    </div>

@endsection