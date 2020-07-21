<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SupplierUser;
use Illuminate\Http\Request;

class SupplierUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info_supplier = SupplierUser::paginate(10);

        return view('pages.admin.user-pemasok.userpemasok')->with(
            [
                'suppliers' => $info_supplier,
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
        $automatic_code = SupplierUser::max('kd_supplier');
        $maxCode = (int) substr($automatic_code, 6, 6);
        $generateCode = $maxCode + 1;
        $addCode = 'SUP000'.sprintf('%06s', $generateCode);

        return view('pages.admin.user-pemasok.tambahpemasok')->with('code', $addCode);
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
                'kd_supplier' => 'required',
                'nama_supplier' => 'required',
                'email' => 'required',
            ],
            [
                'kd_supplier.required' => 'Harap kode supplier tidak boleh kosong!!',
                'nama_supplier.required' => 'Harap nama supplier tidak boleh kosong!!',
                'email.required' => 'Harap email tidak boleh kosong!!',
            ]
        );
        SupplierUser::create($request->all());

        return redirect('/admin/info-pemasok')->with('status', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\SupplierUser $supplierUser
     *
     * @return \Illuminate\Http\Response
     */
    public function show(SupplierUser $supplierUser)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\SupplierUser $supplierUser
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info_supplier = SupplierUser::findOrFail($id);

        return view('pages.admin.user-pemasok.ubahpemasok')->with(
            [
                'suppliers' => $info_supplier,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\SupplierUser        $supplierUser
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
                [
                    'nama_pemasok' => 'required',
                    'email' => 'required',
                ],
                [
                    'nama_pemasok.required' => 'Harap nama supplier tidak boleh kosong!!',
                    'email.required' => 'Harap email tidak boleh kosong!!',
                ]
            );

        SupplierUser::where('id', $id)->update(
            [
                'nama_supplier' => $request->nama_pemasok,
                'email' => $request->email,
            ]
        );

        return redirect('/admin/info-pemasok')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\SupplierUser $supplierUser
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SupplierUser::destroy($id);

        return redirect('/admin/info-pemasok');
    }

    public function cari_supplier(Request $request)
    {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(' ', '%', $query);
            $supplier = SupplierUser::where('id', 'LIKE', '%'.$query.'%')
                                                ->orWhere('kd_supplier', 'LIKE', '%'.$query.'%')
                                                ->orWhere('nama_supplier', 'LIKE', '%'.$query.'%')
                                                ->orWhere('email', 'LIKE', '%'.$query.'%')
                                                ->orderBy($sort_by, $sort_type)
                                                ->paginate(10);

            return view('pages.admin.user-pemasok.pagination_data')
                        ->with('suppliers', $supplier)->render();
        }
    }
}
