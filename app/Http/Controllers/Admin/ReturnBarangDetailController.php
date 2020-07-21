<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ReturnBarang;
use App\ReturnBarangDetail;
use DB;
use Illuminate\Http\Request;

class ReturnBarangDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = ReturnBarang::paginate(10);

        return view('pages.admin.return-barang.detail-return-barang')->with('details', $details);
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
     * @param \App\ReturnBarangDetail $returnBarangDetail
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tgl_return = ReturnBarang::where('kd_return', $id)->first();
        $sum = ReturnBarangDetail::where('kd_return', $id)->sum('sub_total');
        $get_details = DB::table('return_barangs')
                                    ->join('return_barang_details', 'return_barangs.kd_return', '=', 'return_barang_details.kd_return')
                                    ->join('gudangs', 'return_barang_details.kd_gudang', '=', 'gudangs.kd_gudang')
                                    ->join('items', 'gudangs.kd_barang', '=', 'items.kd_barang')
                                    ->where('return_barang_details.kd_return', '=', $id)
                                    ->get();

        return view('pages.admin.return-barang.detail-barang')
                        ->with(
                            [
                                'details' => $get_details,
                                'tanggal' => $tgl_return,
                                'sum' => $sum,
                            ]
                        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\ReturnBarangDetail $returnBarangDetail
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ReturnBarang::where('kd_return', $id)->first();
        $edit = DB::table('return_barangs')
                                    ->join('return_barang_details', 'return_barangs.kd_return', '=', 'return_barang_details.kd_return')
                                    ->join('gudangs', 'return_barang_details.kd_gudang', '=', 'gudangs.kd_gudang')
                                    ->join('items', 'gudangs.kd_barang', '=', 'items.kd_barang')
                                    ->where('return_barang_details.kd_return', '=', $id)
                                    ->get();

        return view('pages.admin.return-barang.ubah-return')->with(
            [
                'returns' => $edit,
                'data' => $data,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ReturnBarangDetail  $returnBarangDetail
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'tgl_return' => 'required',
                'no_return' => 'required',
                'nama' => 'required',
                'alasan' => 'required',
                'alamat' => 'required',
            ],
            [
                'tgl_return.required' => 'Harap tanggal return tidak boleh kosong!!!',
                'no_return.required' => 'Harap nomor return tidak boleh kosong!!!',
                'nama.required' => 'Harap nama tidak boleh kosong!!!',
                'alasan.required' => 'Harap alasan return tidak boleh kosong!!!',
                'alamat.required' => 'Harap alamat return tidak boleh kosong!!!',
            ]
        );
        ReturnBarang::where('kd_return', $id)->update(
            [
                'tgl_return' => $request->tgl_return,
                'kd_return' => $request->no_return,
                'nama' => $request->nama,
                'alasan_return' => $request->alasan,
                'alamat_return' => $request->alamat,
            ]
        );

        return redirect('/admin/detail-return-barang')->with('status', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ReturnBarangDetail $returnBarangDetail
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ReturnBarang::where('kd_return', $id)->delete();
        ReturnBarangDetail::where('kd_return', $id)->delete();

        return redirect('/admin/detail-return-barang');
    }

    public function cari_return(Request $request)
    {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(' ', '%', $query);
            $details = ReturnBarang::where('id', 'LIKE', '%'.$query.'%')
                                                ->orWhere('kd_return', 'LIKE', '%'.$query.'%')
                                                ->orWhere('tgl_return', 'LIKE', '%'.$query.'%')
                                                ->orWhere('nama', 'LIKE', '%'.$query.'%')
                                                ->orWhere('alasan_return', 'LIKE', '%'.$query.'%')
                                                ->orWhere('alamat_return', 'LIKE', '%'.$query.'%')
                                                ->orWhere('total', 'LIKE', '%'.$query.'%')
                                                ->orderBy($sort_by, $sort_type)
                                                ->paginate(10);

            return view('pages.admin.return-barang.pagination_data')
                        ->with('details', $details)->render();
        }
    }
}
