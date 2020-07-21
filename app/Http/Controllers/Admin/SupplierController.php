<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Supplier;
use App\SupplierUser;
use App\Gudang;
use App\Item;
use App\LaporanStok;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::paginate(10);

        return view('pages.admin.pemasok.barangmasuk')->with(
            [
                'data' => $supplier,
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
        $kd_barang = Item::pluck('kd_barang', 'id');

        return view('pages.admin.pemasok.tambahdata')->with(
            [
                'kd_barang' => $kd_barang,
            ]
        );
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
        // $cek_barang = Gudang::where('kd_barang', $request->kd_barang)
        //                                         ->where('harga_supplier', $request->harga_beli)
        //                                         ->first();

        // $cek_stok_baru = LaporanStok::where('tgl', $request->tgl_barang_datang)
        //                                             ->where('kd_barang', $request->kd_barang)
        //                                             ->where('harga_beli', $cek_barang->harga_supplier)
        //                                             ->first();
        // dd($cek_stok_baru);

        $request->validate(
            [
                'kd_supplier' => 'required',
                'nama_supplier' => 'required',
                'kd_barang' => 'required',
                'qty' => 'required',
                'harga_beli' => 'required',
                'tgl_barang_datang' => 'required',
            ],
            [
                'kd_supplier.required' => 'Harap kode supplier tidak boleh kosong!!!',
                'nama_supplier.required' => 'Harap nama supplier tidak boleh kosong!!!',
                'kd_barang.required' => 'Harap kode barang tidak boleh kosong!!!',
                'qty.required' => 'Harap qty tidak boleh kosong!!!',
                'harga_beli.required' => 'Harap harga beli tidak boleh kosong!!!',
                'tgl_barang_datang.required' => 'Harap tanggal tidak boleh kosong!!!',
            ]
        );

        Supplier::create($request->all());

        $automatic_code = Gudang::max('kd_gudang');
        $maxCode = (int) substr($automatic_code, 4, 4);
        $generateCode = $maxCode + 1;
        $addCode = 'GD00'.sprintf('%04s', $generateCode);

        $request->total = $request->qty * $request->harga_beli;

        // $gudang = Gudang::where('kd_barang', $request->kd_barang)->first();

        // Memanggil data terakhir di tabel
        $cek = Supplier::latest()->first();

        $cek_barang = Gudang::where('kd_barang', $request->kd_barang)
                                                ->where('harga_supplier', $request->harga_beli)
                                                ->first();

        if ($cek_barang === null) {
            Gudang::create(
                [
                    'kd_gudang' => $addCode,
                    'kd_supplier' => $request->kd_supplier,
                    'kd_barang' => $request->kd_barang,
                    'harga_supplier' => $request->harga_beli,
                    'harga_jual' => 0,
                    'stok' => $request->qty,
                    'stok_out' => 0,
                ]
            );
        } else {
            $stok = Gudang::where('kd_barang', $request->kd_barang)
                                       ->where('harga_supplier', $request->harga_beli)
                                       ->get();

            foreach ($stok as $total) {
                $total = $total->stok + $request->qty;
                // dd($total = $total->stok + $request->qty);
            }

            Gudang::where('kd_barang', $request->kd_barang)
                            ->where('harga_supplier', $request->harga_beli)
                            ->update(
                                [
                                    'stok' => $total,
                                ]
                            );
        }

        $barang = Item::where('kd_barang', $request->kd_barang)->first();

        // $cek_stok = LaporanStok::latest()->first();

        // if ($cek_stok === null) {
        //     LaporanStok::create(
        //         [
        //             'tgl' => $request->tgl_barang_datang,
        //             'kd_barang' => $request->kd_barang,
        //             'nama_barang' => $barang->nama_barang,
        //             'harga_beli' => $request->harga_beli,
        //             'stok_awal' => 0,
        //             'stok_masuk' => $request->qty,
        //             'stok_keluar' => 0,
        //             'stok_akhir' => $request->qty,
        //         ]
        //     );
        // }

        $cek_stok_baru = LaporanStok::where('tgl', $request->tgl_barang_datang)
                                                        ->where('kd_barang', $request->kd_barang)
                                                        ->where('harga_beli', $request->harga_beli)
                                                        ->first();

        $cek_barang_baru = LaporanStok::where('kd_barang', $request->kd_barang)
                                                                ->where('harga_beli', $request->harga_beli)
                                                                ->get();

        foreach ($cek_barang_baru as $cek) {
            $stok = ($cek->stok_akhir + $request->qty);
        }

        if ($cek_stok_baru === null) {
            LaporanStok::create(
                [
                    'tgl' => $request->tgl_barang_datang,
                    'kd_barang' => $request->kd_barang,
                    'nama_barang' => $barang->nama_barang,
                    'harga_beli' => $request->harga_beli,
                    'stok_awal' => $cek->stok_akhir + 0,
                    'stok_masuk' => $request->qty,
                    'stok_keluar' => 0,
                    'stok_akhir' => $cek->stok_akhir + $request->qty,
                ]
            );
        } else {
            LaporanStok::where('tgl', $request->tgl_barang_datang)
                            ->where('kd_barang', $request->kd_barang)
                            ->where('harga_beli', $request->harga_beli)
                            ->update(
                [
                    'tgl' => $request->tgl_barang_datang,
                    'kd_barang' => $request->kd_barang,
                    'nama_barang' => $barang->nama_barang,
                    'harga_beli' => $request->harga_beli,
                    'stok_awal' => $cek->stok_awal,
                    'stok_masuk' => $cek->stok_masuk + $request->qty,
                    'stok_akhir' => $stok,
                ]
            );
        }

        return redirect('/admin/pemasok')->with('status', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Supplier $supplier
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Supplier $supplier
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('pages.admin.pemasok.ubahdata')->with(
            [
                'supplier' => $supplier,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Supplier            $supplier
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'kd_supplier' => 'required',
                'nama_supplier' => 'required',
                'kd_barang' => 'required',
                'qty' => 'required',
                'harga_beli' => 'required',
                'tgl_barang_datang' => 'required',
            ],
            [
                'kd_supplier.required' => 'Harap kode supplier tidak boleh kosong!!!',
                'nama_supplier.required' => 'Harap nama supplier tidak boleh kosong!!!',
                'kd_barang.required' => 'Harap kode barang tidak boleh kosong!!!',
                'qty.required' => 'Harap qty tidak boleh kosong!!!',
                'harga_beli.required' => 'Harap harga_beli tidak boleh kosong!!!',
                'tgl_barang_datang.required' => 'Harap tanggal tidak boleh kosong!!!',
            ]
        );

        Supplier::where('id', $id)->update(
            [
                'kd_supplier' => $request->kd_supplier,
                'nama_supplier' => $request->nama_supplier,
                'kd_barang' => $request->kd_barang,
                'qty' => $request->qty,
                'harga_beli' => $request->harga_beli,
                'tgl_barang_datang' => $request->tgl_barang_datang,
            ]
        );

        // Stok Update
        $stok = Gudang::where('kd_barang', $request->kd_barang)
                                    ->where('harga_supplier', $request->harga_beli)
                                    ->get();

        foreach ($stok as $total) {
            $total->stok = ($total->stok - $request->before_qty) + $request->qty;
            // dd($total->stok);
        }

        Gudang::where('kd_barang', $request->kd_barang)
                        ->where('harga_supplier', $request->harga_beli)
                        ->update(
                                            [
                                                'stok' => $total->stok,
                                            ]
                                        );

        $cek_barang_baru = LaporanStok::where('kd_barang', $request->kd_barang)
                                ->where('harga_beli', $request->harga_beli)
                                ->get();

        foreach ($cek_barang_baru as $cek) {
            $stok = ($cek->stok_akhir - $request->before_qty) + $request->qty;
        }

        LaporanStok::where('tgl', $request->tgl_barang_datang)
                            ->where('kd_barang', $request->kd_barang)
                            ->where('harga_beli', $request->harga_beli)
                            ->update(
                [
                    'stok_masuk' => $cek->stok_masuk + $request->qty - $request->before_qty,
                    'stok_akhir' => $stok,
                ]
            );

        return redirect('/admin/pemasok')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Supplier $supplier
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        $laporan = LaporanStok::where('tgl', $supplier->tgl_barang_datang)
                                                ->where('kd_barang', $supplier->kd_barang)
                                                ->where('harga_beli', $supplier->harga_beli)
                                                ->first();

        $gudang = Gudang::where('kd_barang', $supplier->kd_barang)
                                        ->where('harga_supplier', $supplier->harga_beli)
                                        ->first();

        $laporan_stok_masuk = $laporan->stok_masuk - $supplier->qty;
        $laporan_stok_akhir = $laporan->stok_akhir - $supplier->qty;
        $gudang_stok = $laporan->stok_masuk - $supplier->qty;

        LaporanStok::where('tgl', $supplier->tgl_barang_datang)
                        ->where('kd_barang', $supplier->kd_barang)
                        ->where('harga_beli', $supplier->harga_beli)
                        ->update(
                            [
                                'stok_masuk' => $laporan_stok_masuk,
                                'stok_akhir' => $laporan_stok_akhir,
                            ]
                        );

        Gudang::where('kd_barang', $supplier->kd_barang)
                    ->where('harga_supplier', $supplier->harga_beli)
                    ->update(
                        [
                            'stok' => $gudang_stok,
                        ]
                    );

        Supplier::destroy($id);

        return redirect('/admin/pemasok');
    }

    public function cari_barang_masuk(Request $request)
    {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(' ', '%', $query);
            $suppliers = Supplier::where('id', 'like', '%'.$query.'%')
                                    ->orWhere('kd_supplier', 'like', '%'.$query.'%')
                                    ->orWhere('nama_supplier', 'like', '%'.$query.'%')
                                    ->orWhere('kd_barang', 'like', '%'.$query.'%')
                                    ->orWhere('qty', 'like', '%'.$query.'%')
                                    ->orWhere('harga_beli', 'like', '%'.$query.'%')
                                    ->orWhere('tgl_barang_datang', 'like', '%'.$query.'%')
                                    ->orderBy($sort_by, $sort_type)
                                    ->paginate(10);

            return view('pages.admin.pemasok.pagination_data')->with('data', $suppliers)->render();
        }
    }

    public function loadData(Request $request)
    {
        if ($request->has('q')) {
            $search = $request->q;
            $data = SupplierUser::where('kd_supplier', 'LIKE', "%$search%")->get();
        }

        return response()->json($data);
    }

    public function codeAjax($id)
    {
        $item = SupplierUser::where('kd_supplier', $id)->get();

        return $item;
    }
}
