<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\LaporanStok;
use App\TransaksiDetail;
use App\Transaksi;
use DB;
use Illuminate\Http\Request;

class LaporanStokController extends Controller
{
    public function index()
    {
        $data = LaporanStok::paginate(10);

        return view('pages.admin.laporan.laporan-barang-masuk.laporan_stok')->with(
            [
                'data' => $data,
            ]
        );
    }

    public function fetch_data(Request $request)
    {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(' ', '%', $query);
            $data = LaporanStok::where('id', 'like', '%'.$query.'%')
                    ->orWhere('tgl', 'like', '%'.$query.'%')
                    ->orWhere('nama_barang', 'like', '%'.$query.'%')
                    ->orWhere('harga_beli', 'like', '%'.$query.'%')
                    ->orWhere('stok_awal', 'like', '%'.$query.'%')
                    ->orWhere('stok_masuk', 'like', '%'.$query.'%')
                    ->orWhere('stok_keluar', 'like', '%'.$query.'%')
                    ->orWhere('stok_akhir', 'like', '%'.$query.'%')
                    ->orderBy($sort_by, $sort_type)
                    ->paginate(10);

            return view('pages.admin.laporan.laporan-barang-masuk.pagination_data')
                        ->with('data', $data)->render();
        }
    }

    public function stockout()
    {
        $laporan = TransaksiDetail::paginate(10);

        return view('pages.admin.laporan.laporan-barang-keluar.laporan_stok_out')->with(
            [
                'reports' => $laporan,
            ]
        );
    }

    public function stockout_detail($id)
    {
        $date = TransaksiDetail::where('kd_transaksi', $id)->first();
        $sum = Transaksi::where('kd_transaksi', $id)->sum('sub_total');

        $laporan = DB::table('transaksis')
                                ->join('gudangs', 'transaksis.kd_gudang', '=', 'gudangs.kd_gudang')
                                ->join('items', 'items.kd_barang', '=', 'gudangs.kd_barang')
                                ->where('transaksis.kd_transaksi', '=', $id)
                                ->get();

        return view('pages.admin.laporan.laporan-barang-keluar.stok-out-detail')->with(
            [
                'reports' => $laporan,
                'tanggal' => $date,
                'sum' => $sum,
            ]
        );
    }

    public function cari_stok_out(Request $request)
    {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(' ', '%', $query);
            $laporan = TransaksiDetail::where('id', 'LIKE', '%'.$query.'%')
                                                    ->orWhere('tgl_transaksi', 'LIKE', '%'.$query.'%')
                                                    ->orWhere('kd_transaksi', 'LIKE', '%'.$query.'%')
                                                    ->orWhere('total', 'LIKE', '%'.$query.'%')
                                                    ->orderBy($sort_by, $sort_type)
                                                    ->paginate(10);

            return view('pages.admin.laporan.laporan-barang-keluar.pagination_data')
                        ->with('reports', $laporan)->render();
        }
    }
}
