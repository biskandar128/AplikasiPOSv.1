<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Transaksi;
use App\Item;
use App\Gudang;
use DB;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
     * @param \App\Transaksi $transaksi
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Transaksi $transaksi
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Transaksi           $transaksi
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Transaksi $transaksi
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
    }

    public function codeAjax($id)
    {
        // Auto Select Item gudang dan item
        $item = DB::table('gudangs')
                            ->join('items', 'gudangs.kd_barang', '=', 'items.kd_barang')
                            ->where('gudangs.status_harga', '=', 'Harga Aktif')
                            ->where('gudangs.kd_gudang', '=', $id)
                            ->get();

        return $item;
    }

    public function loadData(Request $request)
    {
        // Autocomplete Ajax
        if ($request->has('q')) {
            $search = $request->q;
            $data = Gudang::where('kd_gudang', 'LIKE', "%$search%")
                    ->where('status_harga', 'Harga Aktif')
                    ->get();
        }

        return response()->json($data);
    }
}
