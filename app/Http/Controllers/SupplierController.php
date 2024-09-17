<?php

namespace App\Http\Controllers;

use App\DataTables\SupplierDataTable;
use App\Helpers\AuthCommon;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SupplierDataTable $dataTable)
    {
        return $dataTable->render('pages.master_data.supplier.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $body = view('pages.master_data.supplier.create')->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="save()">Save</button>';

        return [
            'title' => 'Create Supplier',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'negara' => 'required',
            'tipe' => 'required',
        ]);
        $data = $request->except('_token');
        try {

            $user = AuthCommon::getUser();
            $trx = Supplier::create([
                'uid' => Str::uuid()->toString(),
                'nama' => $data['nama'],
                'alamat' => $data['alamat'],
                'tipe' => $data['tipe'],
                'negara' => $data['negara'],
                'created_by' => $user->uid,
            ]);
            if ($trx) {
                return response([
                    'status' => true,
                    'message' => 'Berhasil Membuat Supplier'
                ], 200);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Gagal Membuat Supplier'
                ], 400);
            }
        } catch (\Throwable $th) {
            throw $th;
            return response([
                'status' => false,
                'message' => 'Terjadi Kesalahan Internal'
            ], 400);
        } catch (\Illuminate\Database\QueryException $e) {
            return response([
                'status' => false,
                'message' => 'Terjadi Kesalahan Internal',
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        if ($supplier) {
            $uid = $supplier->uid;
            $data = $supplier;
            $body = view('pages.master_data.supplier.edit', compact('uid', 'data'))->render();
            $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save()">Save</button>';
            return [
                'title' => 'Edit Supplier',
                'body' => $body,
                'footer' => $footer
            ];
        } else {
            return response([
                'status' => false,
                'message' => 'Failed Connect to Server'
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'negara' => 'required',
            'tipe' => 'required',
        ]);
        $formData = $request->except(["_token", "_method"]);

        try {
            $user = AuthCommon::getUser();
            $formData['updated_by'] = $user->uid;
            $trx = $supplier->update($formData);
            if ($trx) {
                return response([
                    'status' => true,
                    'message' => 'Data Berhasil Diubah'
                ], 200);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Data Gagal Diubah'
                ], 400);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response([
                'status' => false,
                'message' => 'Kesalahan Internal'
            ], 400);
        } catch (\Illuminate\Database\QueryException $e) {
            return response([
                'status' => false,
                'message' => 'Terjadi Kesalahan Internal',
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        try {
            $delete = $supplier->delete();
            if ($delete) {
                return response()->json([
                    'message' => 'Berhasil Menghapus Data'
                ]);
            } else {
                return response()->json([
                    'message' => 'Gagal Menghapus Data'
                ]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return response([
                'status' => false,
                'message' => 'Gagal Hapus, Data Terpakai di Modul Lain'
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response([
                'status' => false,
                'message' => 'Terjadi Kesalahan Internal',
            ], 400);
        }
    }

    public function select2(Request $request)
    {
        $request->validate([
            'limit' => 'required',
            'page' => 'required'
        ]);

        $limit = $request->limit;
        $start = $limit * $request->page;
        $term = isset($request->term) ? $request->term : '';
        $tipe = $request->tipe; // Get the tipe from the request

        $suppliers = Supplier::where('tipe', $tipe)->get();
        if ($start) {
            $suppliers->skip($start);
        }

        if ($limit) {
            $suppliers->take($limit);
        }

        if ($term != '' && $term) {
            $suppliers = Supplier::where('nama', 'like', '%' . $term . '%')->skip($start)->take($limit)->get();
        }

        $run = DataTables::of($suppliers)->addColumn('id', function ($role) {
            $uid = $role->uid;
            return (string) $uid; // Explicitly cast to string
        })->make(true);
        $decode = json_encode($run);
        $encode = json_decode($decode, true);

        $res['items'] = [];
        $res['total'] = 0;
        if (count($suppliers) > 0) {
            $res['items'] = $encode['original']['data'];
            $res['total'] = $encode['original']['recordsFiltered'];
        }
        return $res;
    }
}
