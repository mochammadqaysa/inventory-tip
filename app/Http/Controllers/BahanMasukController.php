<?php

namespace App\Http\Controllers;

use App\DataTables\BahanMasukDataTable;
use App\Helpers\AuthCommon;
use App\Models\Bahan;
use App\Models\BahanMasuk;
use App\Models\BahanMasukItem;
use App\Models\Gudang;
use App\Models\Supplier;
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
                "nomor_bukti" => $data['nomor_bukti'],
                "tanggal_bukti" => $data['tanggal_bukti'],
                "supplier_uid" => $data['supplier'],
                "nomor_po" => $data['nomor_po'],
                'created_by' => $user->uid,
            ];
            if ($data['tipe'] == "impor") {
                $insert["nomor_pib"] = $data['nomor_pib'];
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
                $insertItem[$key]['nomor_lot'] = $data['nomor_lot'][$key];
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
                    $insertItem[$key]['kode_hs'] = $data['kode_hs'][$key];
                    $insertItem[$key]['nomor_seri'] = $data['nomor_seri'][$key];
                    $insertItem[$key]['mata_uang'] = $data['mata_uang'][$key];
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BahanMasuk $bahanMasuk)
    {
        //
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
}
