<?php

namespace App\Http\Controllers;

use App\DataTables\WasteKeluarDataTable;
use App\Helpers\AuthCommon;
use App\Models\Customer;
use App\Models\JenisWaste;
use App\Models\Waste;
use App\Models\WasteKeluar;
use App\Models\WasteKeluarItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WasteKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WasteKeluarDataTable $dataTable)
    {
        return $dataTable->render('pages.inventory.waste_keluar.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customer = Customer::all();
        $waste = Waste::all();
        $jenisWaste = JenisWaste::all();
        $body = view('pages.inventory.waste_keluar.create', compact('customer', 'waste', 'jenisWaste'))->render();
        $footer = '<button type="button" class="btn btn-close btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-prev btn-primary" onclick="prevStep()" style="display: none;">Sebelumnya</button>
                <button type="button" class="btn btn-next btn-primary" onclick="nextStep()">Lanjut</button>';

        return [
            'title' => 'Create Pengeluaran Waste / Scrap',
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
            'customer' => 'required',
            'nomor_invoice' => 'required',
            'tanggal_invoice' => 'required',
            'nomor_sppb' => 'required',
            'tanggal_sppb' => 'required',
            'nilai' => 'required',
            'jenis_waste.*' => 'required',
            'waste.*' => 'required',
            'nomor_pib.*' => 'required',
            'qty.*' => 'required'
        ]);
        $data = $request->except('_token');
        try {
            $user = AuthCommon::getUser();
            $insert = [
                "uid" => Str::uuid()->toString(),
                "customer_uid" => $data['customer'],
                "nomor_invoice" => strtoupper($data['nomor_invoice']),
                "tanggal_invoice" => $data['tanggal_invoice'],
                "nomor_sppb" => strtoupper($data['nomor_sppb']),
                "tanggal_sppb" => $data['tanggal_sppb'],
                "nilai" => $data['nilai'],
                // "jumlah" => $data['tanggal_bukti'],
                'created_by' => $user->uid,
            ];
            $insertItem = [];
            $jumlah = 0;
            $waste = $data['waste'];
            foreach ($waste as $key => $value) {
                $insertItem[$key]['uid'] = Str::uuid()->toString();
                $insertItem[$key]['waste_keluar_uid'] = $insert['uid'];
                $insertItem[$key]['waste_uid'] = $value;
                $jenisWaste = JenisWaste::find($data['jenis_waste'][$key]);
                $insertItem[$key]['jenis'] = $jenisWaste->nama;
                $insertItem[$key]['nomor_pib'] = strtoupper($data['nomor_pib'][$key]);
                $insertItem[$key]['qty'] = $data['qty'][$key];
                $insertItem[$key]['index'] = $key;
                $nomorPacking = $data['nomor_packing'][$key];
                $insertItem[$key]['nomor_packing'] = implode(',', $nomorPacking);
                $jumlahKgm = $data['jumlah_kgm'][$key];
                $insertItem[$key]['jumlah'] = implode(',', $jumlahKgm);
                $insertItem[$key]['created_by'] = $user->uid;
                $jumlah +=  array_sum($data['jumlah_kgm'][$key]);
            }
            $insert['jumlah'] = $jumlah;

            $trx = WasteKeluar::create($insert);
            if ($trx) {
                $trxItem = WasteKeluarItem::insert($insertItem);
                if ($trxItem) {
                    return response([
                        'status' => true,
                        'message' => 'Berhasil Membuat Pengeluaran Waste / Scrap'
                    ], 200);
                } else {
                    return response([
                        'status' => false,
                        'message' => 'Gagal Membuat Pengeluaran Waste / Scrap'
                    ], 400);
                }
            } else {
                return response([
                    'status' => false,
                    'message' => 'Gagal Membuat Pengeluaran Waste / Scrap'
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
    public function show(WasteKeluar $wasteKeluar)
    {
        $wasteKeluarItems = $wasteKeluar->wasteKeluarItems;
        $body = view('pages.inventory.waste_keluar.detail', compact('wasteKeluar', 'wasteKeluarItems'))->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';

        return [
            'title' => 'Detail Pengeluaran Waste / Scrap',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WasteKeluar $wasteKeluar)
    {
        $uid = $wasteKeluar->uid;
        $data = $wasteKeluar;
        $wasteKeluarItems = $wasteKeluar->wasteKeluarItems->sortBy('index');;
        $jenisWaste = JenisWaste::all();
        $waste = Waste::all();
        $customer = Customer::all();
        $body = view('pages.inventory.waste_keluar.edit', compact('uid', 'data', 'wasteKeluarItems', 'waste', 'jenisWaste', 'customer'))->render();
        $footer = '<button type="button" class="btn btn-close btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-prev btn-primary" onclick="prevStep()" style="display: none;">Sebelumnya</button>
            <button type="button" class="btn btn-next btn-primary" onclick="nextStep()">Lanjut</button>';
        return [
            'title' => 'Edit Pengeluaran Waste / Scrap',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WasteKeluar $wasteKeluar)
    {
        $request->validate([
            'customer' => 'required',
            'nomor_invoice' => 'required',
            'tanggal_invoice' => 'required',
            'nomor_sppb' => 'required',
            'tanggal_sppb' => 'required',
            'nilai' => 'required',
            'jenis_waste.*' => 'required',
            'waste.*' => 'required',
            'nomor_pib.*' => 'required',
            'qty.*' => 'required'
        ]);
        $data = $request->except(["_token", "_method"]);

        try {
            $user = AuthCommon::getUser();

            $wasteKeluar->customer_uid = $data['customer'];
            $wasteKeluar->nomor_invoice = strtoupper($data['nomor_invoice']);
            $wasteKeluar->tanggal_invoice = $data['tanggal_invoice'];
            $wasteKeluar->nomor_sppb = strtoupper($data['nomor_sppb']);
            $wasteKeluar->tanggal_sppb = $data['tanggal_sppb'];
            $wasteKeluar->nilai = $data['nilai'];
            $wasteKeluar->updated_by = $user->uid;


            $trx = $wasteKeluar->save();

            if ($trx) {
                //=================================================== deleting item
                $existingItem = $wasteKeluar->wasteKeluarItems;

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
                $jumlahHeader = 0;
                $waste = $data['waste'];

                foreach ($waste as $key => $value) {
                    // if = edit, else = create
                    if ($key < count($data['waste_item_uid'])) {
                        $item_uid = $data['waste_item_uid'][$key];
                        $wasteKeluarItem = WasteKeluarItem::find($item_uid);
                        $wasteKeluarItem->waste_uid = $value;
                        $jenisWaste = JenisWaste::find($data['jenis_waste'][$key]);
                        $wasteKeluarItem->jenis = $jenisWaste->nama;
                        $wasteKeluarItem->nomor_pib = strtoupper($data['nomor_pib'][$key]);
                        $wasteKeluarItem->qty = $data['qty'][$key];
                        $wasteKeluarItem->index = $key;
                        $nomorPacking = $data['nomor_packing'][$key];
                        $wasteKeluarItem->nomor_packing = implode(',', $nomorPacking);
                        $jumlahKgm = $data['jumlah_kgm'][$key];
                        $wasteKeluarItem->jumlah = implode(',', $jumlahKgm);
                        $wasteKeluarItem->updated_by = $user->uid;
                        $wasteKeluarItem->save();
                        $jumlahHeader +=  array_sum($data['jumlah_kgm'][$key]);
                    } else {
                        $insertItem[$insertIndex]['uid'] = Str::uuid()->toString();
                        $insertItem[$insertIndex]['waste_keluar_uid'] = $wasteKeluar->uid;
                        $insertItem[$insertIndex]['waste_uid'] = $value;
                        $jenisWaste = JenisWaste::find($data['jenis_waste'][$key]);
                        $insertItem[$insertIndex]['jenis'] = $jenisWaste->nama;
                        $insertItem[$insertIndex]['nomor_pib'] = strtoupper($data['nomor_pib'][$key]);
                        $insertItem[$insertIndex]['qty'] = $data['qty'][$key];
                        $insertItem[$insertIndex]['index'] = $key;
                        $nomorPacking = $data['nomor_packing'][$key];
                        $insertItem[$insertIndex]['nomor_packing'] = implode(',', $nomorPacking);
                        $jumlahKgm = $data['jumlah_kgm'][$key];
                        $insertItem[$insertIndex]['jumlah'] = implode(',', $jumlahKgm);
                        $insertItem[$insertIndex]['created_by'] = $user->uid;
                        $jumlahHeader +=  array_sum($data['jumlah_kgm'][$key]);
                        $insertIndex++;
                    }
                }

                $wasteKeluar->jumlah = $jumlahHeader;
                $trx = $wasteKeluar->save();

                $trxItem = WasteKeluarItem::insert($insertItem);
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
    public function destroy(WasteKeluar $wasteKeluar)
    {
        try {
            $delete = $wasteKeluar->delete();
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
