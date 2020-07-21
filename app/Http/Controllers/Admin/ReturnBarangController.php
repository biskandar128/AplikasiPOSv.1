<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ReturnBarang;
use App\Transaksi;
use App\TransaksiDetail;
use App\Gudang;
use App\Item;
use App\LaporanStok;
use App\ReturnBarangDetail;
use DB;
use Illuminate\Http\Request;

class ReturnBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.return-barang.form-return-barang');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $details = DB::table('transaksis')
                                ->join('gudangs', 'transaksis.kd_gudang', '=', 'gudangs.kd_gudang')
                                ->join('items', 'items.kd_barang', '=', 'gudangs.kd_barang')
                                ->where('transaksis.kd_transaksi', 'like', '%'.$request->cari_barang.'%')
                                ->get();

            if ($details) {
                foreach ($details as $detail) {
                    $output .= '<tr>'.
                                            '<td>'.$detail->kd_barang.'</td>'.
                                            '<td>'.$detail->nama_barang.'</td>'.
                                            '<td>'.$detail->harga_jual.'</td>'.
                                            '<td>'.$detail->qty.'</td>'.
                                            '<td class="col_total">'.$detail->sub_total.'</td>'.
                                            '<td align="center"><button class="btn btn-danger" id="return" data-id="'.$detail->kd_gudang.'" value="'.$detail->kd_transaksi.'" onclick="hitung_cost('.$detail->sub_total.')" style="font-size:12px">return</button></td>'.
                                        '</tr>';
                }

                return Response($output);
            }
        }
    }

    public function return($code_transaksi, $code_item, $tgl, $code_return)
    {
        $get_transaksi = Transaksi::where('kd_transaksi', $code_transaksi)
                                                ->where('kd_gudang', $code_item)
                                                ->first();

        $get_gudang = Gudang::where('kd_gudang', $code_item)->first();

        $get_barang = Item::where('kd_barang', $get_gudang->kd_barang)->first();

        $cek_stok_baru = LaporanStok::where('tgl', $tgl)
                                                        ->where('kd_barang', $get_gudang->kd_barang)
                                                        ->where('harga_beli', $get_gudang->harga_supplier)
                                                        ->first();

        $cek_barang_baru = LaporanStok::where('kd_barang', $get_gudang->kd_barang)
                                                            ->where('harga_beli', $get_gudang->harga_supplier)
                                                            ->get();

        foreach ($cek_barang_baru as $cek) {
            $stok = ($cek->stok_akhir + $get_transaksi->qty);
        }

        // Laporan Stok
        if ($cek_stok_baru === null) {
            LaporanStok::create(
                [
                    'tgl' => $tgl,
                    'kd_barang' => $get_gudang->kd_barang,
                    'nama_barang' => $get_barang->nama_barang,
                    'harga_beli' => $get_gudang->harga_supplier,
                    'stok_awal' => $cek->stok_akhir + 0,
                    'stok_masuk' => $get_transaksi->qty,
                    'stok_keluar' => 0,
                    'stok_akhir' => $cek->stok_akhir + $get_transaksi->qty,
                ]
            );
        } else {
            LaporanStok::where('tgl', $tgl)
                            ->where('kd_barang', $get_gudang->kd_barang)
                            ->where('harga_beli', $get_gudang->harga_supplier)
                            ->update(
                [
                    'stok_masuk' => $cek->stok_masuk + $get_transaksi->qty,
                    'stok_akhir' => $stok,
                ]
            );
        }

        $total = $get_gudang->stok + $get_transaksi->qty;

        Gudang::where('kd_gudang', $code_item)
                        ->update(
                            [
                                'stok' => $total,
                            ]
                        );

        ReturnBarangDetail::create(
            [
                'kd_return' => $code_return,
                'kd_transaksi' => $code_transaksi,
                'kd_gudang' => $code_item,
                'qty' => $get_transaksi->qty,
                'sub_total' => $get_transaksi->sub_total,
            ]
        );

        $cost_transaksi = TransaksiDetail::where('kd_transaksi', $code_transaksi)->first();
        $total_cost = $cost_transaksi->total - $get_transaksi->sub_total;
        TransaksiDetail::where('kd_transaksi', $code_transaksi)
                                ->update(
                                    [
                                        'total' => $total_cost,
                                    ]
                                );

        Transaksi::where('kd_transaksi', $code_transaksi)->where('kd_gudang', $code_item)->delete();
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
        ReturnBarang::create(
            [
                'kd_return' => $request->no_retur,
                'tgl_return' => $request->tgl_return,
                'nama' => $request->nama,
                'alasan_return' => $request->alasan,
                'alamat_return' => $request->alamat,
                'total' => $request->total_biaya,
            ]
        );

        return redirect('/admin/form-return-barang');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\ReturBarang $returBarang
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\ReturBarang $returBarang
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnBarang $returBarang)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ReturBarang         $returBarang
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReturnBarang $returBarang)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ReturBarang $returBarang
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnBarang $returBarang)
    {
    }
}
