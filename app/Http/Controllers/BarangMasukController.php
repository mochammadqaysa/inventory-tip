<?php

namespace App\Http\Controllers;

use App\DataTables\BarangMasukDataTable;
use App\Helpers\AuthCommon;
use App\Helpers\Utils;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangMasukItem;
use App\Models\Gudang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BarangMasukDataTable $dataTable)
    {
        return $dataTable->render('pages.inventory.barang_masuk.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barang = Barang::all();
        $gudang = Gudang::all();
        $body = view('pages.inventory.barang_masuk.create', compact('gudang', 'barang'))->render();
        $footer = '<button type="button" class="btn btn-close btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-prev btn-primary" onclick="prevStep()" style="display: none;">Sebelumnya</button>
                <button type="button" class="btn btn-next btn-primary" onclick="nextStep()">Lanjut</button>';

        return [
            'title' => 'Create Pemasukan Barang Jadi',
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
            'gudang' => 'required',
            'nomor_bukti' => 'required',
            'tanggal_bukti' => 'required',
            'barang.*' => 'required',
            'jumlah.*' => 'required',
            'kg_per_item.*' => 'required',
            'netto.*' => 'required',
        ]);
        $data = $request->except('_token');
        try {
            $user = AuthCommon::getUser();
            $insert = [
                "uid" => Str::uuid()->toString(),
                "gudang_uid" => $data['gudang'],
                "nomor_bukti" => strtoupper($data['nomor_bukti']),
                "tanggal_bukti" => $data['tanggal_bukti'],
                'created_by' => $user->uid,
            ];
            $insertItem = [];
            $barang = $data['barang'];
            foreach ($barang as $key => $value) {
                $insertItem[$key]['uid'] = Str::uuid()->toString();
                $insertItem[$key]['barang_masuk_uid'] = $insert['uid'];
                $insertItem[$key]['barang_uid'] = $value;
                $insertItem[$key]['nomor_spk'] = strtoupper($data['nomor_spk'][$key]);
                $insertItem[$key]['jumlah'] = $data['jumlah'][$key];
                $barang = Barang::find($value);
                $sqm = ($barang->panjang * $barang->lebar) / 1000000;
                $insertItem[$key]['jumlah_sqm'] = $sqm * $data['jumlah'][$key];
                $insertItem[$key]['kg_per_item'] = $data['kg_per_item'][$key];
                $insertItem[$key]['netto'] = $data['netto'][$key];
                $insertItem[$key]['created_by'] = $user->uid;
            }

            $trx = BarangMasuk::create($insert);
            if ($trx) {
                $trxItem = BarangMasukItem::insert($insertItem);
                if ($trxItem) {
                    return response([
                        'status' => true,
                        'message' => 'Berhasil Membuat Pemasukan Barang Jadi'
                    ], 200);
                } else {
                    return response([
                        'status' => false,
                        'message' => 'Gagal Membuat Pemasukan Barang Jadi'
                    ], 400);
                }
            } else {
                return response([
                    'status' => false,
                    'message' => 'Gagal Membuat Pemasukan Barang Jadi'
                ], 400);
            }
        } catch (\Throwable $th) {
            // throw $th;
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
    public function show(BarangMasuk $barangMasuk)
    {
        $barangMasukItems = $barangMasuk->barangMasukItems;
        $gudang = $barangMasuk->gudang;
        $body = view('pages.inventory.barang_masuk.detail', compact('barangMasuk', 'barangMasukItems', 'gudang'))->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';

        return [
            'title' => 'Detail Pemasukan Barang Jadi',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangMasuk $barangMasuk)
    {
        $uid = $barangMasuk->uid;
        $data = $barangMasuk;
        $barangMasukItems = $barangMasuk->barangMasukItems;
        $barang = Barang::all();
        $gudang = Gudang::all();
        $body = view('pages.inventory.barang_masuk.edit', compact('uid', 'data', 'barangMasukItems', 'barang', 'gudang'))->render();
        $footer = '<button type="button" class="btn btn-close btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-prev btn-primary" onclick="prevStep()" style="display: none;">Sebelumnya</button>
            <button type="button" class="btn btn-next btn-primary" onclick="nextStep()">Lanjut</button>';
        return [
            'title' => 'Edit Pemasukan Barang Jadi',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        $request->validate([
            'gudang' => 'required',
            'nomor_bukti' => 'required',
            'tanggal_bukti' => 'required',
            'barang.*' => 'required',
            'jumlah.*' => 'required',
            'kg_per_item.*' => 'required',
            'netto.*' => 'required',
        ]);
        $data = $request->except(["_token", "_method"]);

        try {
            $user = AuthCommon::getUser();

            $barangMasuk->gudang_uid = $data['gudang'];
            $barangMasuk->nomor_bukti = strtoupper($data['nomor_bukti']);
            $barangMasuk->tanggal_bukti = $data['tanggal_bukti'];
            $barangMasuk->updated_by = $user->uid;


            $trx = $barangMasuk->save();

            if ($trx) {
                //=================================================== deleting item
                $existingItem = $barangMasuk->barangMasukItems;

                $items = $data['barang_item_uid'];

                $deletedItem = $existingItem->filter(function ($item) use ($items) {
                    return !in_array($item['uid'], $items);
                });
                if (count($deletedItem) > 0) {
                    $deletedItem->each(function ($item) {
                        $item->delete();
                    });
                }
                //================================================== end deleting item

                //================================================== insert and edit data
                $insertItem = [];
                $insertIndex = 0;
                $barang = $data['barang'];

                foreach ($barang as $key => $value) {
                    // if = edit, else = create
                    if ($key < count($data['barang_item_uid'])) {
                        $item_uid = $data['barang_item_uid'][$key];
                        $barangMasukItem = BarangMasukItem::find($item_uid);
                        $barangMasukItem->barang_uid = $value;
                        $barangMasukItem->nomor_spk = strtoupper($data['nomor_spk'][$key]);
                        $barangMasukItem->jumlah = $data['jumlah'][$key];
                        $barang = Barang::find($value);
                        $sqm = ($barang->panjang * $barang->lebar) / 1000000;
                        $barangMasukItem->jumlah_sqm = $sqm * $data['jumlah'][$key];
                        $barangMasukItem->kg_per_item = $data['kg_per_item'][$key];
                        $barangMasukItem->netto = $data['netto'][$key];
                        $barangMasukItem->updated_by = $user->uid;
                        $barangMasukItem->save();
                    } else {
                        $insertItem[$insertIndex]['uid'] = Str::uuid()->toString();
                        $insertItem[$insertIndex]['barang_masuk_uid'] = $barangMasuk->uid;
                        $insertItem[$insertIndex]['barang_uid'] = $value;
                        $insertItem[$insertIndex]['nomor_spk'] = strtoupper($data['nomor_spk'][$key]);
                        $insertItem[$insertIndex]['jumlah'] = $data['jumlah'][$key];
                        $barang = Barang::find($value);
                        $sqm = ($barang->panjang * $barang->lebar) / 1000000;
                        $insertItem[$insertIndex]['jumlah_sqm'] = $sqm * $data['jumlah'][$key];
                        $insertItem[$insertIndex]['kg_per_item'] = $data['kg_per_item'][$key];
                        $insertItem[$insertIndex]['netto'] = $data['netto'][$key];
                        $insertItem[$insertIndex]['created_by'] = $user->uid;
                        $insertIndex++;
                    }
                }

                $trxItem = BarangMasukItem::insert($insertItem);
                if ($trxItem) {
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

                //================================================== end insert and edit data
            } else {
                return response([
                    'status' => false,
                    'message' => 'Data Gagal Diubah'
                ], 400);
            }
        } catch (\Throwable $th) {
            // throw $th;
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
    public function destroy(BarangMasuk $barangMasuk)
    {
        try {
            $delete = $barangMasuk->delete();
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
            // dd($e);
            return response()->json([
                'message' => 'Data Failed, this data is still used in other modules !'
            ]);
        }
    }
}
