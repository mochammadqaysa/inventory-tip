<?php

namespace App\Http\Controllers;

use App\DataTables\BahanDataTable;
use App\Helpers\AuthCommon;
use App\Helpers\Utils;
use App\Models\Bahan;
use App\Models\BahanMasukItem;
use App\Models\WasteKeluarItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Html as ReaderHtml;

class BahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BahanDataTable $dataTable)
    {

        return $dataTable->render('pages.master_data.bahan.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $body = view('pages.master_data.bahan.create')->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="save()">Save</button>';

        return [
            'title' => 'Create Bahan Baku',
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
            'satuan' => 'required',
        ]);
        $data = $request->except('_token');
        try {

            $user = AuthCommon::getUser();
            $trx = Bahan::create([
                'uid' => Str::uuid()->toString(),
                'nama' => $data['nama'],
                'kode' => $data['kode'],
                'satuan' => $data['satuan'],
                'created_by' => $user->uid,
            ]);
            if ($trx) {
                return response([
                    'status' => true,
                    'message' => 'Berhasil Membuat Bahan Baku'
                ], 200);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Gagal Membuat Bahan Baku'
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
    public function show(Bahan $bahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bahan $bahan)
    {
        if ($bahan) {
            $uid = $bahan->uid;
            $data = $bahan;
            $body = view('pages.master_data.bahan.edit', compact('uid', 'data'))->render();
            $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save()">Save</button>';
            return [
                'title' => 'Edit Bahan Baku',
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
    public function update(Request $request, Bahan $bahan)
    {
        $request->validate([
            'nama' => 'required',
            'kode' => 'required',
            'satuan' => 'required',
        ]);
        $formData = $request->except(["_token", "_method"]);

        try {
            $user = AuthCommon::getUser();
            $formData['updated_by'] = $user->uid;
            $trx = $bahan->update($formData);
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
    public function destroy(Bahan $bahan)
    {
        try {
            $delete = $bahan->delete();
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

    public function info_bahan(Request $request)
    {
        try {
            $data = $request->all();
            $bahan = Bahan::find($data['bahan']);
            $stok = Utils::saldoAkhir($bahan, 'bahan');
            return response([
                'status' => true,
                'data' => [
                    "satuan" => $bahan->satuan,
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

    private function notEmptyKg($value)
    {
        return $value != 0;
    }

    public function report_mutasi()
    {
        $bahan = Bahan::all();
        return view('pages.laporan.mutasi_bahan.list', compact('bahan'));
    }

    public function result_mutasi_report(Request $request)
    {
        $request->validate([
            'periode' => 'required',
        ]);
        $periode = explode(' - ', $request->periode);
        $date1 = date('Y-m-d', strtotime($periode[0]));
        $date2 = date('Y-m-d', strtotime($periode[1]));
        $req_bahan = $request->bahan;
        $laporan = [];
        $bahan = Bahan::orderBy('nama');
        if (!is_null($req_bahan) && $req_bahan != '') {
            $bahan->where('uid', $req_bahan);
        }
        $bahans = $bahan->get();

        $laporan = [];
        $total_saldo_awal = [];
        $total_jumlah_masuk = [];
        $total_jumlah_keluar = [];
        $total_jumlah_retur = [];
        $total_saldo_akhir = [];

        // $bahansad = Bahan::where('nama', 'MASKING FILM S1Q1 PLAIN 1240x0.05MM (K)')->first();
        // dd($bahansad->getSaldoAwal($date1));

        foreach ($bahans as $value) {
            // if ($value->kode == "A290XK") {
            //     dd($value->getTotalKeluar($request->periode));
            // }
            $satuan = $value->satuan;
            $saldo_awal = $value->getSaldoAwal($date1);

            $jumlah_masuk = $value->getTotalMasuk($request->periode);
            $jumlah_keluar = $value->getTotalKeluar($request->periode);
            $jumlah_retur = $value->getTotalRetur($request->periode);

            $saldo_akhir = $saldo_awal + $jumlah_masuk + $jumlah_retur - $jumlah_keluar;
            $enter = $this->notEmptyKg($saldo_awal) || $this->notEmptyKg($jumlah_masuk) ||
                $this->notEmptyKg($jumlah_keluar) || $this->notEmptyKg($jumlah_retur) ||
                $this->notEmptyKg($saldo_akhir);



            $gudang = BahanMasukItem::first()->gudang->nama;

            if ($enter) {

                $laporan[] = [
                    "bahan_uid" => $value->uid,
                    "kode" => $value->kode,
                    "nama_bahan" => $value->nama,
                    'satuan' => $satuan,
                    'saldo_awal' => $saldo_awal,
                    'jumlah_masuk' => $jumlah_masuk,
                    'jumlah_keluar' => $jumlah_keluar,
                    'jumlah_retur' => $jumlah_retur,
                    'saldo_akhir' => $saldo_akhir,
                    'gudang' => $gudang,
                ];

                if (array_key_exists($satuan, $total_saldo_awal)) {
                    $total_saldo_awal[$satuan] += $saldo_awal;
                } else {
                    $total_saldo_awal[$satuan] = $saldo_awal;
                }
                if (array_key_exists($satuan, $total_jumlah_masuk)) {
                    $total_jumlah_masuk[$satuan] += $jumlah_masuk;
                } else {
                    $total_jumlah_masuk[$satuan] = $jumlah_masuk;
                }
                if (array_key_exists($satuan, $total_jumlah_keluar)) {
                    $total_jumlah_keluar[$satuan] += $jumlah_keluar;
                } else {
                    $total_jumlah_keluar[$satuan] = $jumlah_keluar;
                }
                if (array_key_exists($satuan, $total_jumlah_retur)) {
                    $total_jumlah_retur[$satuan] += $jumlah_retur;
                } else {
                    $total_jumlah_retur[$satuan] = $jumlah_retur;
                }
                if (array_key_exists($satuan, $total_saldo_akhir)) {
                    $total_saldo_akhir[$satuan] += $saldo_akhir;
                } else {
                    $total_saldo_akhir[$satuan] = $saldo_akhir;
                }
            }
        }

        ksort($total_saldo_awal);
        ksort($total_jumlah_masuk);
        ksort($total_jumlah_keluar);
        ksort($total_jumlah_retur);
        ksort($total_saldo_akhir);

        $stat = [
            'total_saldo_awal' => array_filter($total_saldo_awal, [$this, 'notEmptyKg']),
            'total_jumlah_masuk' => array_filter($total_jumlah_masuk, [$this, 'notEmptyKg']),
            'total_jumlah_keluar' => array_filter($total_jumlah_keluar, [$this, 'notEmptyKg']),
            'total_jumlah_retur' => array_filter($total_jumlah_retur, [$this, 'notEmptyKg']),
            'total_saldo_akhir' => array_filter($total_saldo_akhir, [$this, 'notEmptyKg']),
        ];

        // dd($stat);

        $from = Utils::formatTanggalIndo($date1);
        $to = Utils::formatTanggalIndo($date2);

        return view('pages.laporan.mutasi_bahan.print', compact('laporan', 'stat', 'from', 'to'));
    }

    public function excel_mutasi_report(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'filename' => 'required',
        ]);

        $reader = new ReaderHtml();
        $filename = $request->filename;
        $spreadsheet = $reader->loadFromString($request->content);
        $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
        $spreadsheet->getDefaultStyle()->getFont()->setSize(10);
        $abjad = range('A', 'R');
        foreach ($abjad as $key => $value) {
            $spreadsheet->getActiveSheet()->getColumnDimension($value)->setAutoSize(true);
        }

        $writer = IOFactory::createWriter($spreadsheet, 'Xls');
        $filepath = sys_get_temp_dir() . "/$filename.xls";
        $writer->save($filepath);

        return response()->download($filepath, $filename . '.xls')->deleteFileAfterSend(true);
    }

    public function report_stok()
    {
        $bahan = Bahan::all();
        return view('pages.laporan.stok_bahan.list', compact('bahan'));
    }
    public function result_stok_report(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'periode' => 'required',
        // ]);
        // $periode = explode(' - ', $request->periode);
        // $date1 = date('Y-m-d', strtotime($periode[0]));
        // $date2 = date('Y-m-d', strtotime($periode[1]));
        $req_bahan = $request->bahan;
        $laporan = [];
        $bahan = Bahan::orderBy('nama');
        if (!is_null($req_bahan) && $req_bahan != '') {
            $bahan->where('uid', $req_bahan);
        }
        $bahans = $bahan->get();

        $total = [];
        foreach ($bahans as $value) {
            $saldo_akhir = $value->getSaldoAkhir();
            $satuan = $value->satuan;

            if (array_key_exists($satuan, $total)) {
                $total[$satuan] += $saldo_akhir;
            } else {
                $total[$satuan] = $saldo_akhir;
            }
        }

        ksort($total);

        $stat = [
            'total' => array_filter($total, [$this, 'notEmptyKg']),
        ];


        $today = Utils::formatTanggalIndo(now()->toDateString());

        return view('pages.laporan.stok_bahan.print', compact('bahans', 'stat', 'today'));
    }

    public function excel_stok_report(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'filename' => 'required',
        ]);

        $reader = new ReaderHtml();
        $filename = $request->filename;
        $spreadsheet = $reader->loadFromString($request->content);
        $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
        $spreadsheet->getDefaultStyle()->getFont()->setSize(10);
        $abjad = range('A', 'R');
        foreach ($abjad as $key => $value) {
            $spreadsheet->getActiveSheet()->getColumnDimension($value)->setAutoSize(true);
        }

        $writer = IOFactory::createWriter($spreadsheet, 'Xls');
        $filepath = sys_get_temp_dir() . "/$filename.xls";
        $writer->save($filepath);

        return response()->download($filepath, $filename . '.xls')->deleteFileAfterSend(true);
    }
}
