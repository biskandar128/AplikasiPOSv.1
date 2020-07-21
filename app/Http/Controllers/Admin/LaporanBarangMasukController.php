<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
use DB;

class LaporanBarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Item::all();
        $stok = DB::table('items')
                            ->join('gudangs', 'items.kd_barang', '=', 'gudangs.kd_barang')
                            ->select(DB::raw('gudangs.kd_barang, items.nama_barang , items.kd_jenis, items.berat, sum(stok) as stok'))
                            ->groupBy('gudangs.kd_barang', 'items.nama_barang', 'items.kd_jenis', 'items.berat')
                            ->get();

        // dd($stok);
        return view('pages.admin.laporan.laporan-barang-masuk.daftar')->with(
            [
                'details' => $stok,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param \App\LaporanBarangMasukController $laporanBarangMasukController
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $details = DB::table('items')
                                ->join('gudangs', 'items.kd_barang', '=', 'gudangs.kd_barang')
                                ->where('gudangs.kd_barang', '=', $id)
                                ->get();

        return view('pages.admin.laporan.laporan-barang-masuk.detail')->with(
            [
                'details' => $details,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\LaporanBarangMasukController $laporanBarangMasukController
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(LaporanBarangMasukController $laporanBarangMasukController)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request          $request
     * @param \App\LaporanBarangMasukController $laporanBarangMasukController
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LaporanBarangMasukController $laporanBarangMasukController)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\LaporanBarangMasukController $laporanBarangMasukController
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(LaporanBarangMasukController $laporanBarangMasukController)
    {
    }
}
