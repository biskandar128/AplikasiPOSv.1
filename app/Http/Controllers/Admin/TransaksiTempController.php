<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\TransaksiTemp;
use App\Transaksi;
use App\TransaksiDetail;
use App\Gudang;
use App\LaporanStok;
use Illuminate\Http\Request;
use PDF;

class TransaksiTempController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Automatic Code
        $automatic_code = TransaksiDetail::max('kd_transaksi');
        $maxCode = (int) substr($automatic_code, 6, 6);
        $generateCode = $maxCode + 1;
        $addCode = 'TRS000'.sprintf('%06s', $generateCode);

        $kd_item = Gudang::where('status_harga', 'Harga Aktif')->get();

        $transaksi = TransaksiTemp::all();

        return view('pages.admin.transaksi.formtransaksi')->with(
            [
                'kd_barang' => $kd_item,
                'transaksis' => $transaksi,
                'code' => $addCode,
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
        $items = Gudang::where('kd_gudang', $request->kd_barang)
                                    ->where('status_harga', 'Harga Aktif')
                                    ->get();

        foreach ($items as $code) {
            $code_stok = $code->stok - $request->qty;
            $stok_out = $code->stok_out + $request->qty;
        }

        // dd($code->stok);

        if ($request->transaksi == 'transaksi') {
            $request->validate(
                [
                    'tgl_transaksi' => 'required',
                    'kd_transaksi' => 'required',
                    'kd_barang' => 'required',
                    'nama_barang' => 'required',
                    'harga' => 'required',
                    'qty' => 'required',
                    'sub_total' => 'required',
                ],
                [
                    'tgl_transaksi.required' => 'Harap tanggal transaksi tidak boleh kosong',
                    'kd_transaksi.required' => 'Harap kode transaksi tidak boleh kosong',
                    'kd_barang.required' => 'Harap kode barang tidak boleh kosong',
                    'nama_barang.required' => 'Harap nama barang tidak boleh kosong',
                    'harga.required' => 'Harap harga barang tidak boleh kosong',
                    'qty.required' => 'Harap qty barang tidak boleh kosong',
                    'sub_total.required' => 'Harap sub total barang tidak boleh kosong',
                ]
            );

            TransaksiTemp::create(
                [
                    'kd_transaksi' => $request->kd_transaksi,
                    'kd_barang' => $request->kd_barang,
                    'nama_barang' => $request->nama_barang,
                    'qty' => $request->qty,
                    'harga' => $request->harga,
                    'sub_total' => $request->sub_total,
                    'tgl_transaksi' => $request->tgl_transaksi,
                ]
            );

            Transaksi::create(
                [
                        'kd_transaksi' => $request->kd_transaksi,
                        'kd_gudang' => $request->kd_barang,
                        'qty' => $request->qty,
                        'sub_total' => $request->sub_total,
                        'tgl_transaksi' => $request->tgl_transaksi,
                    ]
            );

            Gudang::where('kd_barang', $code->kd_barang)
                        ->where('status_harga', 'Harga Aktif')
                        ->update(
                            [
                                'stok' => $code_stok,
                                'stok_out' => $stok_out,
                            ]
                        );
            $cek_harga = Gudang::where('kd_barang', $code->kd_barang)
                                ->where('harga_jual', $request->harga)
                                ->first();

            $cek_stok = LaporanStok::where('tgl', $request->tgl_transaksi)
                                ->where('kd_barang', $code->kd_barang)
                                ->where('harga_beli', $code->harga_supplier)
                                ->first();

            $cek_barang_baru = LaporanStok::where('kd_barang', $code->kd_barang)
                                            ->where('harga_beli', $cek_harga->harga_supplier)
                                            ->get();

            foreach ($cek_barang_baru as $cek) {
                $stok = ($cek->stok_keluar + $request->qty);
                $stok_akhir = ($cek->stok_awal + $cek->stok_masuk) - ($cek->stok_keluar + $request->qty);
                $keluar = $cek->stok_keluar + $request->qty;
            }

            if ($cek_stok === null) {
                LaporanStok::create(
                        [
                            'tgl' => $request->tgl_transaksi,
                            'kd_barang' => $code->kd_barang,
                            'nama_barang' => $request->nama_barang,
                            'harga_beli' => $code->harga_supplier + 0,
                            'stok_awal' => $cek->stok_akhir + 0,
                            'stok_masuk' => 0,
                            'stok_keluar' => $request->qty,
                            'stok_akhir' => $stok_akhir,
                        ]
                    );
            } else {
                LaporanStok::where('tgl', $request->tgl_transaksi)
                                        ->where('kd_barang', $code->kd_barang)
                                        ->where('harga_beli', $cek_harga->harga_supplier)
                                        ->update(
                                            [
                                                'stok_keluar' => $keluar,
                                                'stok_akhir' => $stok_akhir,
                                            ]
                                        );
            }

            return redirect('/admin/transaksi')->with('status', 'Transaksi Berhasil Dilakukan');
        }

        if ($request->transaksi_detail == 'transaksi_clear') {
            $request->validate(
                [
                    'tgl_transaksi' => 'required',
                    'total' => 'required',
                    'bayar' => 'required',
                    'kembali' => 'required',
                ],
                [
                    'tgl_transaksi.required' => 'Harap tanggal transaksi tidak boleh kosong!!!',
                    'total.required' => 'Harap total dimasukkan dengan benar',
                    'bayar.required' => 'Harap jumlah uang dimasukkan dengan benar',
                    'kembali.required' => 'Harap kembalian dimasukkan dengan benar',
                ]
            );

            TransaksiDetail::create(
                [
                    'kd_transaksi' => $request->kd_transaksi,
                    'tgl_transaksi' => $request->tgl_transaksi,
                    'total' => $request->total,
                ]
            );

            TransaksiTemp::truncate();

            return redirect('/admin/transaksi')->with('status', 'Transaksi sudah dibayar. Terimakasih ^_^');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\TransaksiTemp $transaksiTemp
     *
     * @return \Illuminate\Http\Response
     */
    public function show(TransaksiTemp $transaksiTemp)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\TransaksiTemp $transaksiTemp
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaksi = TransaksiTemp::findOrFail($id);

        return view('pages.admin.transaksi.formubah')->with(
            [
                'updates' => $transaksi,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\TransaksiTemp       $transaksiTemp
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Mengupdate data dan merubah sistem perhitungan qty ke stok
        $stoks = Gudang::where('kd_gudang', $request->kd_barang)
                                    ->where('status_harga', 'Harga Aktif')
                                    ->get();
        foreach ($stoks as $value) {
            $value_stok = ($value->stok + $request->before_qty) - $request->qty;
            $stok_out = ($value->stok_out - $request->before_qty) + $request->qty;
        }

        // dd($value->stok);

        TransaksiTemp::where('kd_transaksi', $id)->where('kd_barang', $request->kd_barang)->update(
            [
                'qty' => $request->qty,
                'sub_total' => $request->sub_total,
            ]
        );

        Transaksi::where('kd_transaksi', $id)->where('kd_gudang', $request->kd_barang)->update(
            [
                'qty' => $request->qty,
                'sub_total' => $request->sub_total,
            ]
        );

        Gudang::where('kd_barang', $value->kd_barang)
                    ->where('status_harga', 'Harga Aktif')
                    ->update(
                            [
                                'stok' => $value_stok,
                                'stok_out' => $stok_out,
                            ]
                        );

        $cek_barang_baru = LaporanStok::where('tgl', $request->tgl_transaksi)
                                                            ->where('kd_barang', $value->kd_barang)
                                                            ->where('harga_beli', $value->harga_supplier)
                                                            ->get();

        foreach ($cek_barang_baru as $cek) {
            $stok = ($cek->stok_akhir + $request->before_qty) - $request->qty;
        }

        LaporanStok::where('tgl', $request->tgl_transaksi)
                            ->where('kd_barang', $value->kd_barang)
                            ->where('harga_beli', $value->harga_supplier)
                            ->update(
                [
                    'stok_keluar' => $cek->stok_keluar + $request->qty - $request->before_qty,
                    'stok_akhir' => $stok,
                ]
            );

        return redirect('/admin/transaksi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\TransaksiTemp $transaksiTemp
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Hapus data dan mengembalikkan banyak barang yang dibeli
        $qty = TransaksiTemp::findOrFail($id);

        $stok = Gudang::where('kd_gudang', $qty->kd_barang)
                            ->where('status_harga', 'Harga Aktif')
                            ->get();

        foreach ($stok as $stok_beli) {
            $stok_barang = $stok_beli->stok + $qty->qty;
            $stok_out = $stok_beli->stok_out - $qty->qty;
        }

        Gudang::where('kd_gudang', $qty->kd_barang)
                ->where('status_harga', 'Harga Aktif')
                ->update(
                    [
                        'stok' => $stok_barang,
                        'stok_out' => $stok_out,
                    ]
                );

        $cek_barang_baru = LaporanStok::where('tgl', $qty->tgl_transaksi)
                                                            ->where('kd_barang', $stok_beli->kd_barang)
                                                            ->where('harga_beli', $stok_beli->harga_supplier)
                                                            ->get();

        foreach ($cek_barang_baru as $cek) {
            $stok = $cek->stok_akhir + $qty->qty;
            $keluar = $cek->stok_keluar - $qty->qty;
        }

        LaporanStok::where('tgl', $qty->tgl_transaksi)
                            ->where('kd_barang', $stok_beli->kd_barang)
                            ->where('harga_beli', $stok_beli->harga_supplier)
                            ->update(
                [
                    'stok_keluar' => $keluar,
                    'stok_akhir' => $stok,
                ]
            );

        TransaksiTemp::destroy($id);
        Transaksi::where('kd_transaksi', $qty->kd_transaksi)->delete();

        return redirect('/admin/transaksi');
    }

    public function cetak()
    {
        // dd('cek');
        $cetak = TransaksiTemp::all();

        $kode = Transaksi::max('kd_transaksi');

        $transaksi = Transaksi::where('kd_transaksi', $kode)->firstOrFail();

        $total_belanja = 0;
        foreach ($cetak as $total) {
            $total_belanja = $total_belanja + $total->sub_total;
        }

        $pdf = PDF::loadView('pages.admin.transaksi.print', ['cetak' => $cetak, 'transaksi' => $transaksi, 'total' => $total_belanja])->setPaper('A5', 'potrait');

        return $pdf->download('invoice'.$transaksi->kd_transaksi.'.pdf');
    }
}
