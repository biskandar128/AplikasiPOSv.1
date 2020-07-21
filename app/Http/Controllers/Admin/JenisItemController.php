<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\JenisItem;
use Illuminate\Http\Request;

class JenisItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenisItem = JenisItem::paginate(10);

        return view('pages.admin.items.jenis_item.jenisitem')->with(
            [
                'jenisitems' => $jenisItem,
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
        $automatic_code = JenisItem::max('kd_jenis');
        $maxCode = (int) substr($automatic_code, 4, 4);
        $generateCode = $maxCode + 1;
        $addCode = 'JB00'.sprintf('%04s', $generateCode);

        return view('pages.admin.items.jenis_item.tambahjenis')->with('code', $addCode);
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
                'kd_jenis' => 'required',
                'jenis_barang' => 'required',
            ],
            [
                'kd_jenis.required' => 'Harap kode jenis barang tidak boleh kosong!!',
                'jenis_barang.required' => 'Harap nama jenis barang tidak boleh kosong!!',
            ]
        );
        JenisItem::create($request->all());

        return redirect('/admin/jenis_barang')->with('status', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\JenisItem $jenisItem
     *
     * @return \Illuminate\Http\Response
     */
    public function show(JenisItem $jenisItem)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\JenisItem $jenisItem
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jenis_item = JenisItem::findOrFail($id);

        return view('pages.admin.items.jenis_item.ubahjenis')->with(
            [
                'jenis_item' => $jenis_item,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\JenisItem           $jenisItem
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'kd_jenis' => 'required',
                'jenis_barang' => 'required',
            ],
            [
                'kd_jenis.required' => 'Harap kode jenis barang tidak boleh kosong!!',
                'jenis_barang.required' => 'Harap nama jenis barang tidak boleh kosong!!',
            ]
        );

        JenisItem::where('id', $id)->update(
            [
                'kd_jenis' => $request->kd_jenis,
                'jenis_barang' => $request->jenis_barang,
            ]
        );

        return redirect('/admin/jenis_barang')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\JenisItem $jenisItem
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JenisItem::destroy($id);

        return redirect('/admin/jenis_barang');
    }

    public function cari_jb(Request $request)
    {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(' ', '%', $query);
            $jenisItem = JenisItem::where('id', 'LIKE', '%'.$query.'%')
                                                ->orWhere('kd_jenis', 'LIKE', '%'.$query.'%')
                                                ->orWhere('jenis_barang', 'LIKE', '%'.$query.'%')
                                                ->orderBy($sort_by, $sort_type)
                                                ->paginate(10);

            return view('pages.admin.items.jenis_item.pagination_data')
                        ->with('jenisitems', $jenisItem)->render();
        }
    }

    public function loadData(Request $request)
    {
        if ($request->has('q')) {
            $search = $request->q;
            $data = JenisItem::where('kd_jenis', 'LIKE', "%$search%")->get();
        }

        return response()->json($data);
    }

    public function codeAjax($id)
    {
        $item = JenisItem::where('kd_jenis', $id)->get();

        return $item;
    }
}
