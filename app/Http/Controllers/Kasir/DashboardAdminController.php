<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Jenssegers\Date\Date;
use Carbon\Carbon;
use DB;
use App\Aktivitas;
use App\TransaksiDetail;
use App\ReturnBarang;
use App\Supplier;

class DashboardAdminController extends Controller
{
    public function kasir()
    {
        Date::setlocale('id');
        $tgl = Date::now()->format('l, j F Y');
        $test_bulan = Date::now()->format('F');
        $hari = Carbon::now()->format('Y-m-d');
        $bulan = Carbon::now()->format('m');
        $tahun = Carbon::now()->format('Y');
        $cost_transaksi_hari = TransaksiDetail::where('tgl_transaksi', $hari)->sum('total');
        $cost_aktifitas_hari = Aktivitas::where('tgl_aktifitas', $hari)->sum('total_biaya');
        $cost_return_hari = ReturnBarang::where('tgl_return', $hari)->sum('total');
        $cost_supplai_hari = Supplier::select(DB::raw('SUM(qty*harga_beli) as total'))->where('tgl_barang_datang', $hari)->first();
        $jumlah_hari = $cost_transaksi_hari - ($cost_return_hari + $cost_aktifitas_hari + $cost_supplai_hari->total);
        $transaksi_hari = TransaksiDetail::where('tgl_transaksi', $hari)->count('id');
        // dd($transaksi_hari);

        $cost_transaksi_bulan = TransaksiDetail::whereMonth('tgl_transaksi', $bulan)->whereYear('tgl_transaksi', $tahun)->sum('total');
        $cost_aktifitas_bulan = Aktivitas::whereMonth('tgl_aktifitas', $bulan)->whereYear('tgl_aktifitas', $tahun)->sum('total_biaya');
        $cost_return_bulan = ReturnBarang::whereMonth('tgl_return', $bulan)->whereYear('tgl_return', $tahun)->sum('total');
        $cost_supplai_bulan = Supplier::select(DB::raw('SUM(qty*harga_beli) as total'))->whereMonth('tgl_barang_datang', $bulan)->whereYear('tgl_barang_datang', $tahun)->first();
        $jumlah_bulan = $cost_transaksi_bulan - ($cost_return_bulan + $cost_aktifitas_bulan + $cost_supplai_bulan->total);

        $cost_transaksi_tahun = TransaksiDetail::whereYear('tgl_transaksi', $tahun)->sum('total');
        $cost_aktifitas_tahun = Aktivitas::whereYear('tgl_aktifitas', $tahun)->sum('total_biaya');
        $cost_return_tahun = ReturnBarang::whereYear('tgl_return', $tahun)->sum('total');
        $cost_supplai_tahun = Supplier::select(DB::raw('SUM(qty*harga_beli) as total'))->whereYear('tgl_barang_datang', $tahun)->first();
        $jumlah_tahun = $cost_transaksi_tahun - ($cost_return_tahun + $cost_aktifitas_tahun + $cost_supplai_tahun->total);

        $details = TransaksiDetail::select(DB::raw('COUNT(*) as count'))
                    ->whereYear('tgl_transaksi', $tahun)
                    ->groupBy(DB::raw('MONTH(tgl_transaksi)'))
                    ->pluck('count');

        $detail = TransaksiDetail::select(DB::raw('MONTH(tgl_transaksi) as month'))
                    ->whereYear('tgl_transaksi', $tahun)
                    ->groupBy(DB::raw('MONTH(tgl_transaksi)'))
                    ->pluck('month');

        // $coba = Date::parse($detail)->locale('id')->format('F');

        // $pembeli = Transaksi::where('')
        // $bulan_ini = TransaksiDetail::whereMonth('tgl_transaksi', $bulan)->get();
        // foreach ($detail as $key) {
        //     // code...
        // }
        // $pecah = explode('&quot', $detail);
        // $cek = Carbon::parse($pecah)->locale('id')->format('F');
        // dd($cek);

        // Konvert Bulan ke bahasa indonesia
        $bulan =
           [
            1 => 'Januari',
               'Februari',
               'Maret',
               'April',
               'Mei',
               'Juni',
               'Juli',
               'Agustus',
               'September',
                'Oktober',
                'November',
                'Desember',
            ];

        $count_detail = count($detail);

        if ($count_detail == 0) {
            $set = '';
        }

        for ($i = 0; $i < $count_detail; ++$i) {
            $set[] = $bulan[(int) $detail[$i]];
        }

        // End of convert bulan

        return view('pages.kasir.dashboard')->with(
            [
                'biaya_perhari' => $jumlah_hari,
                'biaya_perbulan' => $jumlah_bulan,
                'biaya_pertahun' => $jumlah_tahun,
                'jumlah_transaksi' => $transaksi_hari,
                'details' => $details,
                'detail' => $set,
            ]
        );
    }
}
