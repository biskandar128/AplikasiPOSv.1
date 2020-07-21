<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Item;
use App\JenisItem;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Item::paginate(10);

        return view('pages.admin.items.detail_item.detail')->with(
            [
                'details' => $item,
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
        $automatic_code = Item::max('kd_barang');
        $maxCode = (int) substr($automatic_code, 3, 3);
        $generateCode = $maxCode + 1;
        $addCode = 'G00'.sprintf('%03s', $generateCode);

        $jenisItem = JenisItem::pluck('kd_jenis', 'id')->all();

        return view('pages.admin.items.detail_item.tambahdetail')->with(
                [
                    'jenis_items' => $jenisItem,
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
                'kd_barang' => 'required',
                'nama_barang' => 'required',
                'kd_jenis' => 'required',
                'berat' => 'required',
            ],
            [
                'kd_barang.required' => 'Harap kode barang tidak boleh kosong!!!',
                'nama_barang.required' => 'Harap nama barang tidak boleh kosong!!!',
                'kd_jenis.required' => 'Harap kode jenis barang tidak boleh kosong!!!',
                'berat.required' => 'Harap berat barang tidak boleh kosong!!!',
            ]
        );
        Item::create($request->all());

        return redirect('/admin/detail_barang')->with('status', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Item $item
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Item $item
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jenisItem = JenisItem::pluck('kd_jenis', 'id')->all();

        $item = Item::findOrFail($id);

        return view('pages.admin.items.detail_item.ubahdetail')->with(
            [
                'details' => $item,
                'jenis_items' => $jenisItem,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Item                $item
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'kd_barang' => 'required',
                'nama_barang' => 'required',
                'kd_jenis' => 'required',
                'berat' => 'required',
            ],
            [
                'kd_barang.required' => 'Harap kode barang tidak boleh kosong!!!',
                'nama_barang.required' => 'Harap nama barang tidak boleh kosong!!!',
                'kd_jenis.required' => 'Harap kode jenis barang tidak boleh kosong!!!',
                'berat.required' => 'Harap berat barang tidak boleh kosong!!!',
            ]
        );

        Item::where('id', $id)->update(
            [
                'kd_barang' => $request->kd_barang,
                'nama_barang' => $request->nama_barang,
                'kd_jenis' => $request->kd_jenis,
                'berat' => $request->berat,
            ]
        );

        return redirect('/admin/detail_barang')->with('status', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Item $item
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::destroy($id);

        return redirect('/admin/detail_barang');
    }

    public function cari_barang(Request $request)
    {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(' ', '%', $query);
            $items = Item::where('id', 'LIKE', '%'.$query.'%')
                                ->orWhere('kd_barang', 'LIKE', '%'.$query.'%')
                                ->orWhere('nama_barang', 'LIKE', '%'.$query.'%')
                                ->orWhere('kd_jenis', 'LIKE', '%'.$query.'%')
                                ->orWhere('berat', 'LIKE', '%'.$query.'%')
                                ->orderBy($sort_by, $sort_type)
                                ->paginate(10);

            return view('pages.admin.items.detail_item.pagination_data')
                        ->with('details', $items)->render();
        }
    }

    public function loadData(Request $request)
    {
        if ($request->has('q')) {
            $search = $request->q;
            $item = Item::where('kd_barang', 'LIKE', "%$search%")->get();
        }

        return response()->json($item);
    }

    public function codeAjax($id)
    {
        $item = Item::where('kd_barang', $id)->get();

        return $item;
    }
}
