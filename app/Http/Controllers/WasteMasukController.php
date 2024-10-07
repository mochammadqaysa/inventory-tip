<?php

namespace App\Http\Controllers;

use App\DataTables\WasteMasukDataTable;
use App\Helpers\AuthCommon;
use App\Models\Waste;
use App\Models\WasteMasuk;
use App\Models\WasteMasukItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Html as ReaderHtml;

class WasteMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WasteMasukDataTable $dataTable)
    {
        return $dataTable->render('pages.inventory.waste_masuk.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $waste = Waste::all();
        $body = view('pages.inventory.waste_masuk.create', compact('waste'))->render();
        $footer = '<button type="button" class="btn btn-close btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-prev btn-primary" onclick="prevStep()" style="display: none;">Sebelumnya</button>
                <button type="button" class="btn btn-next btn-primary" onclick="nextStep()">Lanjut</button>';

        return [
            'title' => 'Create Pemasukan Waste / Scrap',
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
            'nomor_bukti' => 'required',
            'tanggal_bukti' => 'required',
            'waste.*' => 'required',
            'jumlah.*' => 'required'
        ]);
        $data = $request->except('_token');
        try {
            $user = AuthCommon::getUser();
            $insert = [
                "uid" => Str::uuid()->toString(),
                "nomor_bukti" => strtoupper($data['nomor_bukti']),
                "tanggal_bukti" => $data['tanggal_bukti'],
                'created_by' => $user->uid,
            ];
            $insertItem = [];
            $waste = $data['waste'];
            foreach ($waste as $key => $value) {
                $insertItem[$key]['uid'] = Str::uuid()->toString();
                $insertItem[$key]['waste_masuk_uid'] = $insert['uid'];
                $insertItem[$key]['waste_uid'] = $value;
                $insertItem[$key]['jumlah'] = $data['jumlah'][$key];
                $insertItem[$key]['created_by'] = $user->uid;
            }

            $trx = WasteMasuk::create($insert);
            if ($trx) {
                $trxItem = WasteMasukItem::insert($insertItem);
                if ($trxItem) {
                    return response([
                        'status' => true,
                        'message' => 'Berhasil Membuat Pemasukan Waste / Scrap'
                    ], 200);
                } else {
                    return response([
                        'status' => false,
                        'message' => 'Gagal Membuat Pemasukan Waste / Scrap'
                    ], 400);
                }
            } else {
                return response([
                    'status' => false,
                    'message' => 'Gagal Membuat Pemasukan Waste / Scrap'
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
    public function show(WasteMasuk $wasteMasuk)
    {
        $wasteMasukItems = $wasteMasuk->wasteMasukItems;
        $body = view('pages.inventory.waste_masuk.detail', compact('wasteMasuk', 'wasteMasukItems'))->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';

        return [
            'title' => 'Detail Pemasukan Waste / Scrap',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WasteMasuk $wasteMasuk)
    {
        $uid = $wasteMasuk->uid;
        $data = $wasteMasuk;
        $wasteMasukItems = $wasteMasuk->wasteMasukItems;
        $waste = Waste::all();
        $body = view('pages.inventory.waste_masuk.edit', compact('uid', 'data', 'wasteMasukItems', 'waste'))->render();
        $footer = '<button type="button" class="btn btn-close btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-prev btn-primary" onclick="prevStep()" style="display: none;">Sebelumnya</button>
            <button type="button" class="btn btn-next btn-primary" onclick="nextStep()">Lanjut</button>';
        return [
            'title' => 'Edit Pemasukan Waste / Scrap',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WasteMasuk $wasteMasuk)
    {
        $request->validate([
            'nomor_bukti' => 'required',
            'tanggal_bukti' => 'required',
            'waste.*' => 'required',
            'jumlah.*' => 'required',
        ]);
        $data = $request->except(["_token", "_method"]);

        try {
            $user = AuthCommon::getUser();

            $wasteMasuk->nomor_bukti = strtoupper($data['nomor_bukti']);
            $wasteMasuk->tanggal_bukti = $data['tanggal_bukti'];
            $wasteMasuk->updated_by = $user->uid;


            $trx = $wasteMasuk->save();

            if ($trx) {
                //=================================================== deleting item
                $existingItem = $wasteMasuk->wasteMasukItems;

                $items = $data['waste_item_uid'];

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
                $waste = $data['waste'];

                foreach ($waste as $key => $value) {
                    // if = edit, else = create
                    if ($key < count($data['waste_item_uid'])) {
                        $item_uid = $data['waste_item_uid'][$key];
                        $wasteMasukItem = WasteMasukItem::find($item_uid);
                        $wasteMasukItem->waste_uid = $value;
                        $wasteMasukItem->jumlah = $data['jumlah'][$key];
                        $wasteMasukItem->updated_by = $user->uid;
                        $wasteMasukItem->save();
                    } else {
                        $insertItem[$insertIndex]['uid'] = Str::uuid()->toString();
                        $insertItem[$insertIndex]['waste_masuk_uid'] = $wasteMasuk->uid;
                        $insertItem[$insertIndex]['waste_uid'] = $value;
                        $insertItem[$insertIndex]['jumlah'] = $data['jumlah'][$key];
                        $insertItem[$insertIndex]['created_by'] = $user->uid;
                        $insertIndex++;
                    }
                }

                $trxItem = WasteMasukItem::insert($insertItem);
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
    public function destroy(WasteMasuk $wasteMasuk)
    {
        try {
            $delete = $wasteMasuk->delete();
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

    public function report()
    {
        $waste = Waste::all();
        return view('pages.laporan.waste_masuk.list', compact('waste'));
    }
}
