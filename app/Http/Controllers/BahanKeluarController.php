<?php

namespace App\Http\Controllers;

use App\DataTables\BahanKeluarDataTable;
use App\Helpers\AuthCommon;
use App\Models\Bagian;
use App\Models\Bahan;
use App\Models\BahanKeluar;
use App\Models\BahanKeluarItem;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BahanKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BahanKeluarDataTable $dataTable)
    {
        return $dataTable->render('pages.inventory.bahan_keluar.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bagian = Bagian::all();
        $bahan = Bahan::all();
        $body = view('pages.inventory.bahan_keluar.create', compact('bagian', 'bahan'))->render();
        $footer = '<button type="button" class="btn btn-close btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-prev btn-primary" onclick="prevStep()" style="display: none;">Sebelumnya</button>
                <button type="button" class="btn btn-next btn-primary" onclick="nextStep()">Lanjut</button>';

        return [
            'title' => 'Create Pengeluaran Bahan Baku',
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
            'transaksi' => 'required',
            'bagian' => 'required',
            'nomor_bukti' => 'required',
            'tanggal_bukti' => 'required',
            'bahan.*' => 'required',
            'jumlah.*' => 'required',
        ]);
        $data = $request->except('_token');
        try {
            $user = AuthCommon::getUser();
            $insert = [
                "uid" => Str::uuid()->toString(),
                "transaksi" => strtoupper($data['transaksi']),
                "nomor_bukti" => strtoupper($data['nomor_bukti']),
                "tanggal_bukti" => $data['tanggal_bukti'],
                "bagian_uid" => $data['bagian'],
                "nomor_spk" => strtoupper($data['nomor_spk']),
                'created_by' => $user->uid,
            ];
            $insertItem = [];
            $bahan = $data['bahan'];
            foreach ($bahan as $key => $value) {
                $insertItem[$key]['uid'] = Str::uuid()->toString();
                $insertItem[$key]['bahan_keluar_uid'] = $insert['uid'];
                $insertItem[$key]['bahan_uid'] = $value;
                $insertItem[$key]['jumlah'] = $data['jumlah'][$key];
                $bahan = Bahan::find($value);
                if (strtolower($bahan->satuan) == 'kg') {
                    $insertItem[$key]['jumlah_kg'] = $data['jumlah'][$key];
                } else {
                    $insertItem[$key]['jumlah_kg'] = $data['jumlah_kg'][$key];
                }
                $insertItem[$key]['created_by'] = $user->uid;
            }

            $trx = BahanKeluar::create($insert);
            if ($trx) {
                $trxItem = BahanKeluarItem::insert($insertItem);
                if ($trxItem) {
                    return response([
                        'status' => true,
                        'message' => 'Berhasil Membuat Pengeluaran Bahan Baku'
                    ], 200);
                } else {
                    return response([
                        'status' => false,
                        'message' => 'Gagal Membuat Pengeluaran Bahan Baku'
                    ], 400);
                }
            } else {
                return response([
                    'status' => false,
                    'message' => 'Gagal Membuat Pengeluaran Bahan Baku'
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
    public function show(BahanKeluar $bahanKeluar)
    {
        $bahanKeluarItems = $bahanKeluar->bahanKeluarItems;
        $bagian = $bahanKeluar->bagian;
        $body = view('pages.inventory.bahan_keluar.detail', compact('bahanKeluar', 'bahanKeluarItems', 'bagian'))->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';

        return [
            'title' => 'Detail Pengeluaran Bahan Baku',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BahanKeluar $bahanKeluar)
    {
        $uid = $bahanKeluar->uid;
        $data = $bahanKeluar;
        $bahanKeluarItems = $bahanKeluar->bahanKeluarItems;
        $bahan = Bahan::all();
        $bagian = Bagian::all();
        foreach ($bahanKeluarItems as $key => $value) {
            $bahanKeluarItems[$key]['nama_bahan'] = $value->bahan->nama;
            // $bahanKeluarItems[$key]['nama_gudang'] = $value->gudang->nama;
        }
        $body = view('pages.inventory.bahan_keluar.edit', compact('uid', 'data', 'bahanKeluarItems', 'bahan', 'bagian'))->render();
        $footer = '<button type="button" class="btn btn-close btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-prev btn-primary" onclick="prevStep()" style="display: none;">Sebelumnya</button>
            <button type="button" class="btn btn-next btn-primary" onclick="nextStep()">Lanjut</button>';
        return [
            'title' => 'Edit Pengeluaran Bahan Baku',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BahanKeluar $bahanKeluar)
    {
        $request->validate([
            'transaksi' => 'required',
            'bagian' => 'required',
            'nomor_bukti' => 'required',
            'tanggal_bukti' => 'required',
            'bahan.*' => 'required',
            'jumlah.*' => 'required',
        ]);
        $data = $request->except(["_token", "_method"]);

        try {
            $user = AuthCommon::getUser();
            $data['updated_by'] = $user->uid;

            $bahanKeluar->transaksi = strtoupper($data['transaksi']);
            $bahanKeluar->nomor_bukti = strtoupper($data['nomor_bukti']);
            $bahanKeluar->tanggal_bukti = $data['tanggal_bukti'];
            $bahanKeluar->nomor_spk = strtoupper($data['nomor_spk']);
            $bahanKeluar->bagian_uid = $data['bagian'];
            $bahanKeluar->updated_by = $user->uid;


            $trx = $bahanKeluar->save();

            if ($trx) {
                //=================================================== deleting item
                $existingItem = $bahanKeluar->bahanKeluarItems;

                $items = $data['bahan_item_uid'];

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
                $bahan = $data['bahan'];

                foreach ($bahan as $key => $value) {
                    // if = edit, else = create
                    if ($key < count($data['bahan_item_uid'])) {
                        $item_uid = $data['bahan_item_uid'][$key];
                        $bahanKeluarItem = BahanKeluarItem::find($item_uid);
                        $bahanKeluarItem->bahan_uid = $value;
                        $bahanKeluarItem->jumlah = $data['jumlah'][$key];
                        $bahan = Bahan::find($value);
                        if (strtolower($bahan->satuan) == 'kg') {
                            $bahanKeluarItem->jumlah_kg = $data['jumlah'][$key];
                        } else {
                            $bahanKeluarItem->jumlah_kg = $data['jumlah_kg'][$key];
                        }
                        $bahanKeluarItem->updated_by = $user->uid;
                        $bahanKeluarItem->save();
                    } else {
                        $insertItem[$insertIndex]['uid'] = Str::uuid()->toString();
                        $insertItem[$insertIndex]['bahan_keluar_uid'] = $bahanKeluar->uid;
                        $insertItem[$insertIndex]['bahan_uid'] = $value;
                        $insertItem[$insertIndex]['jumlah'] = $data['jumlah'][$key];
                        $bahan = Bahan::find($value);
                        if (strtolower($bahan->satuan) == 'kg') {
                            $insertItem[$insertIndex]['jumlah_kg'] = $data['jumlah'][$key];
                        } else {
                            $insertItem[$insertIndex]['jumlah_kg'] = $data['jumlah_kg'][$key];
                        }
                        $insertItem[$insertIndex]['created_by'] = $user->uid;
                        $insertIndex++;
                    }
                }

                $trxItem = BahanKeluarItem::insert($insertItem);
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
    public function destroy(BahanKeluar $bahanKeluar)
    {
        try {
            $delete = $bahanKeluar->delete();
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
