<?php

namespace App\Http\Controllers;

use App\DataTables\BarangDataTable;
use App\Helpers\AuthCommon;
use App\Helpers\Utils;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BarangDataTable $dataTable)
    {
        return $dataTable->render('pages.master_data.barang.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $body = view('pages.master_data.barang.create')->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="save()">Save</button>';

        return [
            'title' => 'Create Barang Jadi',
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
            'kode' => 'required',
            'warna' => 'required',
            'panjang' => 'required',
            'lebar' => 'required',
            'tebal' => 'required',
            'satuan' => 'required',
        ]);
        $data = $request->except('_token');
        try {

            $user = AuthCommon::getUser();
            $trx = Barang::create([
                'uid' => Str::uuid()->toString(),
                'nama' => $data['nama'],
                'kode' => $data['kode'],
                'warna' => $data['warna'],
                'panjang' => $data['panjang'],
                'lebar' => $data['lebar'],
                'tebal' => $data['tebal'] > 9.99 ? 9.99 : $data['tebal'],
                'satuan' => $data['satuan'],
                'created_by' => $user->uid,
            ]);
            if ($trx) {
                return response([
                    'status' => true,
                    'message' => 'Berhasil Membuat Barang Jadi'
                ], 200);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Gagal Membuat Barang Jadi'
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
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        if ($barang) {
            $uid = $barang->uid;
            $data = $barang;
            $body = view('pages.master_data.barang.edit', compact('uid', 'data'))->render();
            $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save()">Save</button>';
            return [
                'title' => 'Edit Barang Jadi',
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
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama' => 'required',
            'kode' => 'required',
            'warna' => 'required',
            'panjang' => 'required',
            'lebar' => 'required',
            'tebal' => 'required',
            'satuan' => 'required',
        ]);
        $formData = $request->except(["_token", "_method"]);

        try {
            $user = AuthCommon::getUser();
            $formData['updated_by'] = $user->uid;
            $formData['tebal'] = $formData['tebal'] > 9.99 ? 9.99 : $formData['tebal'];
            $trx = $barang->update($formData);
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
    public function destroy(Barang $barang)
    {
        try {
            $delete = $barang->delete();
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
            return response()->json([
                'message' => 'Data Failed, this data is still used in other modules !'
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response([
                'status' => false,
                'message' => 'Terjadi Kesalahan Internal',
            ], 400);
        }
    }

    public function info_barang(Request $request)
    {
        try {
            $data = $request->all();
            $barang = Barang::find($data['barang']);
            $stok = Utils::saldoAkhir($barang, 'barang');
            return response([
                'status' => true,
                'data' => [
                    "satuan" => $barang->satuan,
                    "stok" => $stok
                ]
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            response([
                'status' => false,
            ], 400);
        }
    }
}
