<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Gudang;
use App\SupplierUser;
use App\Item;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Gudang::paginate(10);

        return view('pages.kasir.gudang.daftarstok')->with(
            [
                'details' => $data,
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
        $automatic_code = Gudang::max('kd_gudang');
        $maxCode = (int) substr($automatic_code, 4, 4);
        $generateCode = $maxCode + 1;
        $addCode = 'GD00'.sprintf('%04s', $generateCode);

        $code_supplier = SupplierUser::pluck('kd_supplier', 'id');

        $code_barang = Item::pluck('kd_barang', 'id');

        return view('pages.kasir.gudang.tambah')->with(
            [
                'code_supplier' => $code_supplier,
                'code_barang' => $code_barang,
                'code' => $addCode,
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
        $request->validate(
            [
                'kd_gudang' => 'required',
                'kd_supplier' => 'required',
                'kd_barang' => 'required',
                'harga_supplier' => 'required',
                'harga_jual' => 'required',
                'stok' => 'required',
                'status_harga' => 'required',
            ],
            [
                'kd_gudang.required' => 'Harap kode gudang tidak boleh kosong!!!',
                'kd_supplier.required' => 'Harap kode supplier tidak boleh kosong!!!',
                'kd_barang.required' => 'Harap kode barang tidak boleh kosong!!!',
                'harga_supplier.required' => 'Harap harga supplier tidak boleh kosong!!!',
                'harga_jual.required' => 'Harap harga jual tidak boleh kosong!!!',
                'stok.required' => 'Harap stok tidak boleh kosong!!!',
                'status_harga.required' => 'Harap status barang tidak boleh kosong!!!',
            ]
        );

        Gudang::create($request->all());

        return redirect('/kasir/gudang')->with('status', 'Data Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Gudang $gudang
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Gudang $gudang)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Gudang $gudang
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = Gudang::findOrFail($id);

        return view('pages.kasir.gudang.ubah')->with(
            [
                'gudang' => $edit,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Gudang              $gudang
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'kd_gudang' => 'required',
                'kd_pemasok' => 'required',
                'kd_barang' => 'required',
                'harga_supplier' => 'required',
                'harga_jual' => 'required',
                'stok' => 'required',
                'status_harga' => 'required',
            ],
            [
                'kd_gudang.required' => 'Harap kode gudang tidak boleh kosong!!!',
                'kd_pemasok.required' => 'Harap kode supplier tidak boleh kosong!!!',
                'kd_barang.required' => 'Harap kode barang tidak boleh kosong!!!',
                'harga_supplier.required' => 'Harap harga supplier tidak boleh kosong!!!',
                'harga_jual.required' => 'Harap harga jual tidak boleh kosong!!!',
                'stok.required' => 'Harap stok tidak boleh kosong!!!',
                'status_barang.required' => 'Harap status barang tidak boleh kosong!!!',
            ]
        );
        Gudang::where('id', $id)->update(
            [
                'harga_jual' => $request->harga_jual,
                'status_harga' => $request->status_harga,
            ]
        );

        return redirect('/kasir/gudang')->with('status', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Gudang $gudang
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gudang::destroy($id);

        return redirect('/kasir/gudang');
    }

    public function cari_gudang(Request $request)
    {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(' ', '%', $query);
            $data = Gudang::where('id', 'like', '%'.$query.'%')
                                    ->orWhere('kd_gudang', 'like', '%'.$query.'%')
                                    ->orWhere('kd_supplier', 'like', '%'.$query.'%')
                                    ->orWhere('kd_barang', 'like', '%'.$query.'%')
                                    ->orWhere('harga_supplier', 'like', '%'.$query.'%')
                                    ->orWhere('harga_jual', 'like', '%'.$query.'%')
                                    ->orWhere('stok', 'like', '%'.$query.'%')
                                    ->orWhere('status_harga', 'like', '%'.$query.'%')
                                    ->orderBy($sort_by, $sort_type)
                                    ->paginate(10);

            return view('pages.kasir.gudang.pagination_data')->with('details', $data)->render();
        }
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
