<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\AktifitasDetail;
use App\AktifitasDetailTemp;
use App\Aktivitas;
use Illuminate\Http\Request;

class AktifitasDetailController extends Controller
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
        // Automatic Code
        $automatic_code = Aktivitas::max('kd_aktivitas');
        $maxCode = (int) substr($automatic_code, 6, 6);
        $generateCode = $maxCode + 1;
        $addCode = 'AKT000'.sprintf('%06s', $generateCode);

        $detail = AktifitasDetailTemp::all();

        return view('pages.kasir.aktivitas.aktivitas')
                ->with(
                    [
                        'code' => $addCode,
                        'details' => $detail,
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
        if ($request->btn_tambah == 'tambah_biaya') {
            $request->validate(
                [
                    'kd_aktifitas' => 'required',
                    'tgl_aktifitas' => 'required',
                    'nama_aktifitas' => 'required',
                    'biaya_keluar' => 'required',
                    'total_biaya' => 'required',
                ],
                [
                    'kd_aktifitas.required' => 'Harap kode aktifitas tidak boleh kosong!!',
                    'tgl_aktifitas.required' => 'Harap kode aktifitas tidak boleh kosong!!',
                    'nama_aktifitas.required' => 'Harap kode aktifitas tidak boleh kosong!!',
                    'biaya_keluar.required' => 'Harap kode aktifitas tidak boleh kosong!!',
                    'total_biaya.required' => 'Harap kode aktifitas tidak boleh kosong!!',
                ]
            );

            AktifitasDetail::create(
                [
                    'kd_aktivitas' => $request->kd_aktifitas,
                    'tgl_aktifitas' => $request->tgl_aktifitas,
                    'aktifitas' => $request->nama_aktifitas,
                    'total_biaya' => $request->biaya_keluar,
                ]
            );

            AktifitasDetailTemp::create(
                [
                    'kd_aktivitas' => $request->kd_aktifitas,
                    'tgl_aktifitas' => $request->tgl_aktifitas,
                    'aktifitas' => $request->nama_aktifitas,
                    'total_biaya' => $request->biaya_keluar,
                ]
            );

            return redirect('/kasir/tambah-aktifitas')->with('status', 'Data Aktifitas Selesai Ditambahkan');
        } elseif ($request->btn_selesai == 'selesai_aktifitas') {
            $request->validate(
                [
                    'tgl_aktifitas' => 'required',
                ],
                [
                    'tgl_aktifitas.required' => 'Harap kode aktifitas tidak boleh kosong!!',
                ]
            );
            Aktivitas::create(
                    [
                        'kd_aktivitas' => $request->kd_aktifitas,
                        'tgl_aktifitas' => $request->tgl_aktifitas,
                        'total_biaya' => $request->total_biaya,
                    ]
                );

            AktifitasDetailTemp::truncate();

            return redirect('/kasir/tambah-aktifitas')->with('status', 'Data Aktifitas Berhasil Disimpan. Terimakasih');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\AktifitasDetail $aktifitasDetail
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $total_biaya = Aktivitas::where('kd_aktivitas', $id)->first();
        $reports = AktifitasDetail::where('kd_aktivitas', $id)->get();

        return view('pages.kasir.aktivitas.detail-aktifitas')->with(
                    [
                    'reports' => $reports,
                    'total_biaya' => $total_biaya,
                    ]
                );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\AktifitasDetail $aktifitasDetail
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($aktifitas, $code)
    {
        $details = AktifitasDetailTemp::where('aktifitas', $aktifitas)->where('kd_aktivitas', $code)->first();

        return view('pages.kasir.aktivitas.ubah-aktifitas')->with('details', $details);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\AktifitasDetail     $aktifitasDetail
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $aktifitas)
    {
        AktifitasDetailTemp::where('kd_aktivitas', $id)
                                    ->where('aktifitas', $aktifitas)
                                    ->update(
                                        [
                                            'aktifitas' => $request->nama_aktifitas,
                                            'total_biaya' => $request->biaya_keluar,
                                        ]
                                    );

        AktifitasDetail::where('kd_aktivitas', $id)
                            ->where('aktifitas', $aktifitas)
                            ->update(
                                [
                                    'aktifitas' => $request->nama_aktifitas,
                                    'total_biaya' => $request->biaya_keluar,
                                ]
                            );

        return redirect('/kasir/tambah-aktifitas')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\AktifitasDetail $aktifitasDetail
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $code)
    {
        AktifitasDetail::where('aktifitas', $id)->where('kd_aktivitas', $code)->delete();
        AktifitasDetailTemp::where('aktifitas', $id)->where('kd_aktivitas', $code)->delete();

        return redirect('/kasir/tambah-aktifitas');
    }
}
