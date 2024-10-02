<?php

namespace App\Http\Controllers;

use App\DataTables\BahanMasukDataTable;
use App\Helpers\AuthCommon;
use App\Helpers\Utils;
use App\Models\Bahan;
use App\Models\BahanMasuk;
use App\Models\BahanMasukItem;
use App\Models\Gudang;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BahanMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BahanMasukDataTable $dataTable)
    {
        return $dataTable->render('pages.inventory.bahan_masuk.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bahan = Bahan::all();
        $gudang = Gudang::all();
        $body = view('pages.inventory.bahan_masuk.create', compact('bahan', 'gudang'))->render();
        $footer = '<button type="button" class="btn btn-close btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-prev btn-primary" onclick="prevStep()" style="display: none;">Sebelumnya</button>
                <button type="button" class="btn btn-next btn-primary" onclick="nextStep()">Lanjut</button>';

        return [
            'title' => 'Create Pemasukan Bahan Baku',
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
            'tipe' => 'required',
            'supplier' => 'required',
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
                "tipe" => $data['tipe'],
                "nomor_bukti" => strtoupper($data['nomor_bukti']),
                "tanggal_bukti" => $data['tanggal_bukti'],
                "supplier_uid" => $data['supplier'],
                "nomor_po" => strtoupper($data['nomor_po']),
                'created_by' => $user->uid,
            ];
            if ($data['tipe'] == "impor") {
                $insert["nomor_pib"] = strtoupper($data['nomor_pib']);
                $insert["tanggal_pib"] = $data['tanggal_pib'];
                $insert['kurs'] = $data['kurs'];
                if (!is_null($data['tanggal_pib'])) {
                    $pibExpire = new DateTime($data['tanggal_pib']);
                    $pibExpire->modify('+4 months');
                    $insert['tanggal_pib_expire'] = $pibExpire->format('Y-m-d');
                }
            }
            $insertItem = [];
            $bahan = $data['bahan'];
            foreach ($bahan as $key => $value) {
                $insertItem[$key]['uid'] = Str::uuid()->toString();
                $insertItem[$key]['bahan_masuk_uid'] = $insert['uid'];
                $insertItem[$key]['bahan_uid'] = $value;
                $insertItem[$key]['gudang_uid'] = $data['gudang_penyimpanan'][$key];
                $insertItem[$key]['nomor_lot'] = strtoupper($data['nomor_lot'][$key]);
                $insertItem[$key]['jumlah'] = $data['jumlah'][$key];
                $bahan = Bahan::find($value);
                if (strtolower($bahan->satuan) == 'kg') {
                    $insertItem[$key]['jumlah_kg'] = $data['jumlah'][$key];
                } else {
                    $insertItem[$key]['jumlah_kg'] = $data['jumlah_kg'][$key];
                }
                $insertItem[$key]['nilai_total'] = $data['nilai_total'][$key];
                $insertItem[$key]['created_by'] = $user->uid;

                $insertItem[$key]['mata_uang'] = "IDR";
                if ($data['tipe'] == "impor") {
                    $insertItem[$key]['kode_hs'] = strtoupper($data['kode_hs'][$key]);
                    $insertItem[$key]['nomor_seri'] = strtoupper($data['nomor_seri'][$key]);
                    $insertItem[$key]['mata_uang'] = strtoupper($data['mata_uang'][$key]);
                    $insertItem[$key]['nilai'] = $data['nilai'][$key];
                    $insertItem[$key]['asuransi'] = $data['asuransi'][$key];
                    $insertItem[$key]['ongkos'] = $data['ongkos'][$key];
                    $insertItem[$key]['nilai_total'] = $data['nilai_total'][$key];
                    $insertItem[$key]['fasilitas'] = $data['fasilitas'][$key] == "ya" ? 1 : 0;
                }
            }
            // dd($insertItem);

            $trx = BahanMasuk::create($insert);
            if ($trx) {
                $trxItem = BahanMasukItem::insert($insertItem);
                if ($trxItem) {
                    return response([
                        'status' => true,
                        'message' => 'Berhasil Membuat Pemasukan Bahan Baku'
                    ], 200);
                } else {
                    return response([
                        'status' => false,
                        'message' => 'Gagal Membuat Pemasukan Bahan Baku'
                    ], 400);
                }
            } else {
                return response([
                    'status' => false,
                    'message' => 'Gagal Membuat Pemasukan Bahan Baku'
                ], 400);
            }
        } catch (\Throwable $th) {
            //throw $th;
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
    public function show(BahanMasuk $bahanMasuk)
    {
        $bahanMasukItems = $bahanMasuk->bahanMasukItems;
        $supplier = $bahanMasuk->supplier;
        $body = view('pages.inventory.bahan_masuk.detail', compact('bahanMasuk', 'bahanMasukItems', 'supplier'))->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';

        return [
            'title' => 'Detail Pemasukan Bahan Baku',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BahanMasuk $bahanMasuk)
    {
        if ($bahanMasuk) {
            $uid = $bahanMasuk->uid;
            $data = $bahanMasuk;
            $bahanMasukItems = $bahanMasuk->bahanMasukItems;
            $bahan = Bahan::all();
            $gudang = Gudang::all();
            foreach ($bahanMasukItems as $key => $value) {
                $bahanMasukItems[$key]['nama_bahan'] = $value->bahan->nama;
                $bahanMasukItems[$key]['nama_gudang'] = $value->gudang->nama;
            }
            $body = view('pages.inventory.bahan_masuk.edit', compact('uid', 'data', 'bahanMasukItems', 'bahan', 'gudang'))->render();
            $footer = '<button type="button" class="btn btn-close btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-prev btn-primary" onclick="prevStep()" style="display: none;">Sebelumnya</button>
                <button type="button" class="btn btn-next btn-primary" onclick="nextStep()">Lanjut</button>';
            return [
                'title' => 'Edit Pemasukan Bahan Baku',
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
    public function update(Request $request, BahanMasuk $bahanMasuk)
    {
        $request->validate([
            'tipe' => 'required',
            'supplier' => 'required',
            'nomor_bukti' => 'required',
            'tanggal_bukti' => 'required',
            'bahan.*' => 'required',
            'jumlah.*' => 'required',
        ]);
        $data = $request->except(["_token", "_method"]);

        try {
            $user = AuthCommon::getUser();
            $data['updated_by'] = $user->uid;

            $bahanMasuk->tipe = $data['tipe'];
            $bahanMasuk->nomor_bukti = strtoupper($data['nomor_bukti']);
            $bahanMasuk->nomor_po = strtoupper($data['nomor_po']);
            $bahanMasuk->supplier_uid = $data['supplier'];
            $bahanMasuk->tanggal_bukti = $data['tanggal_bukti'];
            $bahanMasuk->updated_by = $user->uid;

            if ($data['tipe'] == "impor") {
                $bahanMasuk->nomor_pib = strtoupper($data['nomor_pib']);
                $bahanMasuk->kurs = $data['kurs'];
                $bahanMasuk->tanggal_pib = $data['tanggal_pib'];
                if (!is_null($data['tanggal_pib'])) {
                    $pibExpire = new DateTime($data['tanggal_pib']);
                    $pibExpire->modify('+4 months');
                    $bahanMasuk->tanggal_pib_expire = $pibExpire->format('Y-m-d');
                }
            } else {
                $bahanMasuk->nomor_pib = null;
                $bahanMasuk->kurs = null;
                $bahanMasuk->tanggal_pib = null;
                $bahanMasuk->tanggal_pib_expire = null;
            }

            $trx = $bahanMasuk->save();

            if ($trx) {
                //=================================================== deleting item
                $existingItem = $bahanMasuk->bahanMasukItems;

                if (isset($data['bahan_item_uid'])) {
                    $items = $data['bahan_item_uid'];

                    $deletedItem = $existingItem->filter(function ($item) use ($items) {
                        return !in_array($item['uid'], $items);
                    });
                    if (count($deletedItem) > 0) {
                        $deletedItem->each(function ($item) {
                            $item->delete();
                        });
                    }
                } else {
                    $data['bahan_item_uid'] = [];
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
                        $bahanMasukItem = BahanMasukItem::find($item_uid);
                        $bahanMasukItem->bahan_uid = $value;
                        $bahanMasukItem->gudang_uid = $data['gudang_penyimpanan'][$key];
                        $bahanMasukItem->nomor_lot = strtoupper($data['nomor_lot'][$key]);
                        $bahanMasukItem->jumlah = $data['jumlah'][$key];
                        $bahan = Bahan::find($value);
                        if (strtolower($bahan->satuan) == 'kg') {
                            $bahanMasukItem->jumlah_kg = $data['jumlah'][$key];
                        } else {
                            $bahanMasukItem->jumlah_kg = $data['jumlah_kg'][$key];
                        }
                        $bahanMasukItem->nilai_total = $data['nilai_total'][$key];
                        $bahanMasukItem->updated_by = $user->uid;
                        $bahanMasukItem->mata_uang = "IDR";
                        if ($data['tipe'] == "impor") {
                            $bahanMasukItem->kode_hs = strtoupper($data['kode_hs'][$key]);
                            $bahanMasukItem->nomor_seri = strtoupper($data['nomor_seri'][$key]);
                            $bahanMasukItem->mata_uang = strtoupper($data['mata_uang'][$key]);
                            $bahanMasukItem->nilai = $data['nilai'][$key];
                            $bahanMasukItem->asuransi = $data['asuransi'][$key];
                            $bahanMasukItem->ongkos = $data['ongkos'][$key];
                            $bahanMasukItem->nilai_total = $data['nilai_total'][$key];
                            $bahanMasukItem->fasilitas = $data['fasilitas'][$key] == "ya" ? 1 : 0;
                        }
                        $bahanMasukItem->save();
                    } else {
                        $insertItem[$insertIndex]['uid'] = Str::uuid()->toString();
                        $insertItem[$insertIndex]['bahan_masuk_uid'] = $bahanMasuk->uid;
                        $insertItem[$insertIndex]['bahan_uid'] = $value;
                        $insertItem[$insertIndex]['gudang_uid'] = $data['gudang_penyimpanan'][$key];
                        $insertItem[$insertIndex]['nomor_lot'] = strtoupper($data['nomor_lot'][$key]);
                        $insertItem[$insertIndex]['jumlah'] = $data['jumlah'][$key];
                        $bahan = Bahan::find($value);
                        if (strtolower($bahan->satuan) == 'kg') {
                            $insertItem[$insertIndex]['jumlah_kg'] = $data['jumlah'][$key];
                        } else {
                            $insertItem[$insertIndex]['jumlah_kg'] = $data['jumlah_kg'][$key];
                        }
                        $insertItem[$insertIndex]['nilai_total'] = $data['nilai_total'][$key];
                        $insertItem[$insertIndex]['created_by'] = $user->uid;

                        $insertItem[$insertIndex]['mata_uang'] = "IDR";
                        if ($data['tipe'] == "impor") {
                            $insertItem[$insertIndex]['kode_hs'] = strtoupper($data['kode_hs'][$key]);
                            $insertItem[$insertIndex]['nomor_seri'] = strtoupper($data['nomor_seri'][$key]);
                            $insertItem[$insertIndex]['mata_uang'] = strtoupper($data['mata_uang'][$key]);
                            $insertItem[$insertIndex]['nilai'] = $data['nilai'][$key];
                            $insertItem[$insertIndex]['asuransi'] = $data['asuransi'][$key];
                            $insertItem[$insertIndex]['ongkos'] = $data['ongkos'][$key];
                            $insertItem[$insertIndex]['nilai_total'] = $data['nilai_total'][$key];
                            $insertItem[$insertIndex]['fasilitas'] = $data['fasilitas'][$key] == "ya" ? 1 : 0;
                        }
                        $insertIndex++;
                    }
                }

                $trxItem = BahanMasukItem::insert($insertItem);
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
            throw $th;
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
    public function destroy(BahanMasuk $bahanMasuk)
    {
        try {
            $delete = $bahanMasuk->delete();
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
        }
    }

    public function report()
    {
        $bahan = Bahan::all();
        return view('pages.laporan.bahan_masuk.list', compact('bahan'));
    }

    public function result_report(Request $request)
    {
        $request->validate([
            'periode' => 'required',
            'tipe' => 'required',
        ]);
        // dd($request->all());
        $laporan = [];
        $periode = explode(' - ', $request->periode);
        $date1 = date('Y-m-d', strtotime($periode[0]));
        $date2 = date('Y-m-d', strtotime($periode[1]));
        $tipe = $request->tipe;
        $bahan = $request->bahan;
        $fasilitas = $request->fasilitas;
        $bahanMasukItems = BahanMasukItem::with(['bahan', 'bahanMasuk', 'gudang'])
            ->whereHas('bahanMasuk', function ($query) use ($date1, $date2, $tipe) {
                $query->where('tanggal_bukti', '>=', $date1)
                    ->where('tanggal_bukti', '<=', $date2);
            });
        if ($tipe != 'semua') {
            $bahanMasukItems->whereHas('bahanMasuk', function ($query) use ($tipe) {
                $query->where('tipe', $tipe);
            });
            if ($tipe == 'impor') {
                if ($fasilitas != 'semua') {
                    $bahanMasukItems->where('fasilitas', $fasilitas == 'ya' ? 1 : 0);
                }
            }
        }
        if (!is_null($bahan) && $bahan != '') {
            $bahanMasukItems->where('bahan_uid', $bahan);
        }
        $bahanMasukItems = $bahanMasukItems->get();

        $total_jumlah = [];
        $total_nilai = [];
        $total_asuransi = [];
        $total_ongkos = [];
        $total_nilai_total = '0.00';
        foreach ($bahanMasukItems as $key => $value) {
            $jumlah = $value->jumlah;
            $satuan = $value->bahan->satuan;
            if (array_key_exists($satuan, $total_jumlah)) {
                $total_jumlah[$satuan] += $jumlah;
            } else {
                $total_jumlah[$satuan] = $jumlah;
            }

            $nilai = $value->nilai;
            $asuransi = $value->asuransi;
            $ongkos = $value->ongkos;
            $mata_uang = $value->mata_uang;
            if (!is_null($nilai) && !is_null($mata_uang)) {
                if (array_key_exists($mata_uang, $total_nilai)) {
                    $total_nilai[$mata_uang] += $nilai;
                } else {
                    $total_nilai[$mata_uang] = $nilai;
                }
            }
            if (!is_null($asuransi) && !is_null($mata_uang)) {
                if (array_key_exists($mata_uang, $total_asuransi)) {
                    $total_asuransi[$mata_uang] += $asuransi;
                } else {
                    $total_asuransi[$mata_uang] = $asuransi;
                }
            }
            if (!is_null($ongkos) && !is_null($mata_uang)) {
                if (array_key_exists($mata_uang, $total_ongkos)) {
                    $total_ongkos[$mata_uang] += $ongkos;
                } else {
                    $total_ongkos[$mata_uang] = $ongkos;
                }
            }

            $nilai_total = $value->nilai_total;
            if (!is_null($nilai_total)) {
                $total_nilai_total += $nilai_total;
            }
        }


        $stat = [
            'total_jumlah' => $total_jumlah,
            'total_nilai' => $total_nilai,
            'total_asuransi' => $total_asuransi,
            'total_ongkos' => $total_ongkos,
            'total_nilai_total' => $total_nilai_total
        ];

        $from = Utils::formatTanggalIndo($date1);
        $to = Utils::formatTanggalIndo($date2);

        return view('pages.laporan.bahan_masuk.print', compact('bahanMasukItems', 'stat', 'from', 'to'));


        // return redirect()->route('print-report.bahan-masuk', ['bahanMasukItems' => $bahanMasukItems->get()]);
    }

    public function print_report()
    {
        return view('pages.laporan.bahan_masuk.print');
        // $pdf = FacadePdf::loadView('pages.laporan.bahan_masuk.print')->setPaper('a4', 'landscape');
        // return $pdf->stream();
    }
}
