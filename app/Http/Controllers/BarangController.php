<?php

namespace App\Http\Controllers;

use App\DataTables\BarangDataTable;
use App\Helpers\AuthCommon;
use App\Helpers\Utils;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangMasukItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Html as ReaderHtml;

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
            throw $th;
            response([
                'status' => false,
            ], 400);
        }
    }

    public function report_mutasi()
    {
        $barang = Barang::all();
        return view('pages.laporan.mutasi_barang.list', compact('barang'));
    }

    private function notEmptyKg($value)
    {
        return $value != 0;
    }

    public function result_mutasi_report(Request $request)
    {
        $request->validate([
            'periode' => 'required',
        ]);

        $periode = explode(' - ', $request->periode);
        $date1 = date('Y-m-d', strtotime($periode[0]));
        $date2 = date('Y-m-d', strtotime($periode[1]));
        $req_barang = $request->barang;
        $barang = Barang::orderBy('nama', 'ASC')->orderBy('warna', 'ASC')
            ->orderBy('panjang', 'ASC')
            ->orderBy('lebar', 'ASC')
            ->orderBy('tebal', 'ASC');
        if (!is_null($req_barang) && $req_barang != '') {
            $barang->where('uid', $req_barang);
        }
        $barangs = $barang->get();

        $laporan = [];
        $total_saldo_awal = ['jumlah' => [], 'netto' => '0.000'];
        $total_masuk = ['jumlah' => [], 'netto' => '0.000'];
        $total_keluar = ['jumlah' => [], 'netto' => '0.000'];
        $total_saldo_akhir = ['jumlah' => [], 'netto' => '0.000'];
        foreach ($barangs as $value) {
            $satuan = $value->satuan;
            $saldo_awal = $value->getSaldoAwal($date1);
            $saldo_awal_netto = $value->getSaldoAwal($date1, 'netto');
            $jumlah_masuk = $value->getTotalMasuk($request->periode);
            $jumlah_masuk_netto = $value->getTotalMasuk($request->periode, 'netto');
            $jumlah_keluar = $value->getTotalKeluar($request->periode);
            $jumlah_keluar_netto = $value->getTotalKeluar($request->periode, 'netto');

            $saldo_akhir_jumlah = $saldo_awal + $jumlah_masuk - $jumlah_keluar;
            $saldo_akhir_netto = $saldo_awal_netto + $jumlah_masuk_netto - $jumlah_keluar_netto;

            $saldo_akhir = [
                'jumlah' => $saldo_akhir_jumlah,
                'netto' => $saldo_akhir_netto,
            ];

            $enter = $this->notEmptyKg($saldo_awal) || $this->notEmptyKg($jumlah_masuk) ||
                $this->notEmptyKg($jumlah_keluar) || $this->notEmptyKg($saldo_akhir_jumlah) ||
                $this->notEmptyKg($saldo_awal_netto) || $this->notEmptyKg($jumlah_masuk_netto) ||
                $this->notEmptyKg($jumlah_keluar_netto) || $this->notEmptyKg($saldo_akhir_netto);

            $gudang = BarangMasuk::first()->gudang->nama;
            if ($enter) {
                $laporan[] = [
                    "barang_id" => $value->uid,
                    "kode" => $value->kode,
                    "nama_barang" => "$value->nama $value->warna $value->panjang x $value->lebar x $value->tebal",
                    'satuan' => $satuan,
                    'saldo_awal' => [
                        'jumlah' => $saldo_awal,
                        'netto' => $saldo_awal_netto,
                    ],
                    'masuk' => [
                        'jumlah' => $jumlah_masuk,
                        'netto' => $jumlah_masuk_netto,
                    ],
                    'keluar' => [
                        'jumlah' => $jumlah_keluar,
                        'netto' => $jumlah_keluar_netto,
                    ],
                    'saldo_akhir' => $saldo_akhir,
                    'gudang' => $gudang,
                ];

                $total_saldo_awal['jumlah'][$satuan] = ($total_saldo_awal['jumlah'][$satuan] ?? 0) + $saldo_awal;
                $total_masuk['jumlah'][$satuan] = ($total_masuk['jumlah'][$satuan] ?? 0) + $jumlah_masuk;
                $total_keluar['jumlah'][$satuan] = ($total_keluar['jumlah'][$satuan] ?? 0) + $jumlah_keluar;
                $total_saldo_akhir['jumlah'][$satuan] = ($total_saldo_akhir['jumlah'][$satuan] ?? 0) + $saldo_akhir_jumlah;

                $total_saldo_awal['netto'] += $saldo_awal_netto;
                $total_masuk['netto'] += $jumlah_masuk_netto;
                $total_keluar['netto'] += $jumlah_keluar_netto;
                $total_saldo_akhir['netto'] += $saldo_akhir_netto;
            }
        }

        ksort($total_saldo_awal['jumlah']);
        ksort($total_masuk['jumlah']);
        ksort($total_keluar['jumlah']);
        ksort($total_saldo_akhir['jumlah']);

        $stat = [
            'total_saldo_awal' => array_filter($total_saldo_awal['jumlah'], [$this, 'notEmptyKg']),
            'netto_saldo_awal' => $this->notEmptyKg($total_saldo_awal['netto']) ? $total_saldo_awal['netto'] : null,
            'total_masuk' => array_filter($total_masuk['jumlah'], [$this, 'notEmptyKg']),
            'netto_masuk' => $this->notEmptyKg($total_masuk['netto']) ? $total_masuk['netto'] : null,
            'total_keluar' => array_filter($total_keluar['jumlah'], [$this, 'notEmptyKg']),
            'netto_keluar' => $this->notEmptyKg($total_keluar['netto']) ? $total_keluar['netto'] : null,
            'total_saldo_akhir' => array_filter($total_saldo_akhir['jumlah'], [$this, 'notEmptyKg']),
            'netto_saldo_akhir' => $this->notEmptyKg($total_saldo_akhir['netto']) ? $total_saldo_akhir['netto'] : null,
        ];

        $from = Utils::formatTanggalIndo($date1);
        $to = Utils::formatTanggalIndo($date2);

        return view('pages.laporan.mutasi_barang.print', compact('laporan', 'stat', 'from', 'to'));
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
        $barang = Barang::all();
        return view('pages.laporan.stok_barang.list', compact('barang'));
    }

    public function result_stok_report(Request $request)
    {
        $req_barang = $request->barang;
        $barang = Barang::orderBy('nama', 'ASC')->orderBy('warna', 'ASC')
            ->orderBy('panjang', 'ASC')
            ->orderBy('lebar', 'ASC')
            ->orderBy('tebal', 'ASC');
        if (!is_null($req_barang) && $req_barang != '') {
            $barang->where('uid', $req_barang);
        }
        $barangs = $barang->get();

        $total_jumlah = [];
        $total_netto = '0';
        foreach ($barangs as $value) {
            $saldo_akhir = $value->getSaldoAkhir();
            $saldo_akhir_netto = $value->getSaldoAkhir('netto');
            $satuan = $value->satuan;

            if (array_key_exists($satuan, $total_jumlah)) {
                $total_jumlah[$satuan] += $saldo_akhir;
            } else {
                $total_jumlah[$satuan] = $saldo_akhir;
            }
            $total_netto += $saldo_akhir_netto;
        }

        ksort($total_jumlah);

        $stat = [
            'total_jumlah' => $total_jumlah,
            'total_netto'  => $total_netto,
        ];


        $today = Utils::formatTanggalIndo(now()->toDateString());

        return view('pages.laporan.stok_barang.print', compact('barangs', 'stat', 'today'));
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
