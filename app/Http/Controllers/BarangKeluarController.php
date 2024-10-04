<?php

namespace App\Http\Controllers;

use App\DataTables\BarangKeluarDataTable;
use App\Helpers\AuthCommon;
use App\Helpers\Utils;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangKeluarItem;
use App\Models\Customer;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Html as ReaderHtml;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BarangKeluarDataTable $dataTable)
    {
        return $dataTable->render('pages.inventory.barang_keluar.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customer = Customer::all();
        $barang = Barang::all();
        $body = view('pages.inventory.barang_keluar.create', compact('customer', 'barang'))->render();
        $footer = '<button type="button" class="btn btn-close btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-prev btn-primary" onclick="prevStep()" style="display: none;">Sebelumnya</button>
                <button type="button" class="btn btn-next btn-primary" onclick="nextStep()">Lanjut</button>';

        return [
            'title' => 'Create Pengeluaran Barang Jadi',
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
            'nomor_peb' => 'required_if:tipe,ekspor',
            'tanggal_peb' => 'required_if:tipe,ekspor',
            'customer' => 'required',
            'nomor_bukti' => 'required',
            'tanggal_bukti' => 'required',
            'barang.*' => 'required',
            'bruto.*' => 'required',
            'netto.*' => 'required',
        ]);
        $data = $request->except('_token');
        try {
            $user = AuthCommon::getUser();
            $insert = [
                "uid" => Str::uuid()->toString(),
                "tipe" => $data['tipe'],
                "customer_uid" => $data['customer'],
                "nomor_bukti" => strtoupper($data['nomor_bukti']),
                "tanggal_bukti" => $data['tanggal_bukti'],
                'created_by' => $user->uid,
            ];
            if ($data['tipe'] == "ekspor") {
                $insert["nomor_peb"] = strtoupper($data['nomor_peb']);
                $insert["tanggal_peb"] = $data['tanggal_peb'];
            } else {
                $insert["ppn"] = $data['ppn'];
            }
            $insertItem = [];
            $barang = $data['barang'];
            foreach ($barang as $key => $value) {
                $insertItem[$key]['uid'] = Str::uuid()->toString();
                $insertItem[$key]['barang_keluar_uid'] = $insert['uid'];
                $insertItem[$key]['barang_uid'] = $value;
                $insertItem[$key]['jumlah'] = $data['jumlah'][$key];
                $insertItem[$key]['bruto'] = $data['bruto'][$key];
                $insertItem[$key]['netto'] = $data['netto'][$key];
                $insertItem[$key]['nilai'] = $data['nilai'][$key];
                $barang = Barang::find($value);
                $sqm = ($barang->panjang * $barang->lebar) / 1000000;
                $insertItem[$key]['jumlah_sqm'] = $sqm * $data['jumlah'][$key];
                $insertItem[$key]['created_by'] = $user->uid;

                if ($data['tipe'] == "ekspor") {
                    $insertItem[$key]['mata_uang'] = strtoupper($data['mata_uang'][$key]);
                    $insertItem[$key]['nilai_total'] = $data['nilai'][$key];
                } else {
                    $insertItem[$key]['mata_uang'] = "IDR";
                    $insertItem[$key]['nilai_total'] = $data['nilai_total'][$key];
                    $insertItem[$key]['nilai_ppn'] = $data['nilai_ppn'][$key];
                }
            }
            // dd($insertItem);

            $trx = BarangKeluar::create($insert);
            if ($trx) {
                $trxItem = BarangKeluarItem::insert($insertItem);
                if ($trxItem) {
                    return response([
                        'status' => true,
                        'message' => 'Berhasil Membuat Pengeluaran Barang Jadi'
                    ], 200);
                } else {
                    return response([
                        'status' => false,
                        'message' => 'Gagal Membuat Pengeluaran Barang Jadi'
                    ], 400);
                }
            } else {
                return response([
                    'status' => false,
                    'message' => 'Gagal Membuat Pengeluaran Barang Jadi'
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
    public function show(BarangKeluar $barangKeluar)
    {
        $barangKeluarItems = $barangKeluar->barangKeluarItems;
        $customer = $barangKeluar->customer;
        $body = view('pages.inventory.barang_keluar.detail', compact('barangKeluar', 'barangKeluarItems', 'customer'))->render();
        $footer = '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';

        return [
            'title' => 'Detail Pengeluaran Barang Jadi',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangKeluar $barangKeluar)
    {
        $uid = $barangKeluar->uid;
        $data = $barangKeluar;
        $barangKeluarItems = $barangKeluar->barangKeluarItems;
        $barang = Barang::all();
        $customer = Customer::all();
        $body = view('pages.inventory.barang_keluar.edit', compact('uid', 'data', 'barangKeluarItems', 'barang', 'customer'))->render();
        $footer = '<button type="button" class="btn btn-close btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-prev btn-primary" onclick="prevStep()" style="display: none;">Sebelumnya</button>
            <button type="button" class="btn btn-next btn-primary" onclick="nextStep()">Lanjut</button>';
        return [
            'title' => 'Edit Pengeluaran Barang Jadi',
            'body' => $body,
            'footer' => $footer
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangKeluar $barangKeluar)
    {
        $request->validate([
            'tipe' => 'required',
            'nomor_peb' => 'required_if:tipe,ekspor',
            'tanggal_peb' => 'required_if:tipe,ekspor',
            'customer' => 'required',
            'nomor_bukti' => 'required',
            'tanggal_bukti' => 'required',
            'barang.*' => 'required',
            'bruto.*' => 'required',
            'netto.*' => 'required',
        ]);
        $data = $request->except(["_token", "_method"]);

        try {
            $user = AuthCommon::getUser();
            $data['updated_by'] = $user->uid;

            $barangKeluar->tipe = $data['tipe'];
            $barangKeluar->customer_uid = $data['customer'];
            $barangKeluar->nomor_bukti = strtoupper($data['nomor_bukti']);
            $barangKeluar->tanggal_bukti = $data['tanggal_bukti'];
            $barangKeluar->updated_by = $user->uid;

            if ($data['tipe'] == "ekspor") {
                $barangKeluar->nomor_peb = strtoupper($data['nomor_peb']);
                $barangKeluar->tanggal_peb = $data['tanggal_peb'];
                $insert["ppn"] = null;
            } else {
                $insert["ppn"] = $data['ppn'];
                $barangKeluar->nomor_peb = null;
                $barangKeluar->tanggal_peb = null;
            }

            $trx = $barangKeluar->save();

            if ($trx) {
                //=================================================== deleting item
                $existingItem = $barangKeluar->barangKeluarItems;

                if (isset($data['barang_item_uid'])) {
                    $items = $data['barang_item_uid'];

                    $deletedItem = $existingItem->filter(function ($item) use ($items) {
                        return !in_array($item['uid'], $items);
                    });
                    if (count($deletedItem) > 0) {
                        $deletedItem->each(function ($item) {
                            $item->delete();
                        });
                    }
                } else {
                    $data['barang_item_uid'] = [];
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
                        $barangKeluarItem = BarangKeluarItem::find($item_uid);
                        $barangKeluarItem->barang_uid = $value;
                        $barangKeluarItem->jumlah = $data['jumlah'][$key];
                        $barangKeluarItem->bruto = $data['bruto'][$key];
                        $barangKeluarItem->netto = $data['netto'][$key];
                        $barangKeluarItem->nilai = $data['nilai'][$key];
                        $barang = Barang::find($value);
                        $sqm = ($barang->panjang * $barang->lebar) / 1000000;
                        $barangKeluarItem->jumlah_sqm = $sqm * $data['jumlah'][$key];
                        $barangKeluarItem->updated_by = $user->uid;

                        if ($data['tipe'] == "ekspor") {
                            $barangKeluarItem->mata_uang = strtoupper($data['mata_uang'][$key]);
                            $barangKeluarItem->nilai_total = $data['nilai'][$key];
                            $barangKeluarItem->nilai_ppn = null;
                        } else {
                            $barangKeluarItem->mata_uang = "IDR";
                            $barangKeluarItem->nilai_total = $data['nilai_total'][$key];
                            $barangKeluarItem->nilai_ppn = $data['nilai_ppn'][$key];
                        }
                        $barangKeluarItem->save();
                    } else {
                        $insertItem[$insertIndex]['uid'] = Str::uuid()->toString();
                        $insertItem[$insertIndex]['barang_keluar_uid'] = $barangKeluar->uid;
                        $insertItem[$insertIndex]['barang_uid'] = $value;
                        $insertItem[$insertIndex]['jumlah'] = $data['jumlah'][$key];
                        $insertItem[$insertIndex]['bruto'] = $data['bruto'][$key];
                        $insertItem[$insertIndex]['netto'] = $data['netto'][$key];
                        $insertItem[$insertIndex]['nilai'] = $data['nilai'][$key];
                        $barang = Barang::find($value);
                        $sqm = ($barang->panjang * $barang->lebar) / 1000000;
                        $insertItem[$insertIndex]['jumlah_sqm'] = $sqm * $data['jumlah'][$key];
                        $insertItem[$insertIndex]['created_by'] = $user->uid;

                        if ($data['tipe'] == "ekspor") {
                            $insertItem[$insertIndex]['mata_uang'] = strtoupper($data['mata_uang'][$key]);
                            $insertItem[$insertIndex]['nilai_total'] = $data['nilai'][$key];
                        } else {
                            $insertItem[$insertIndex]['mata_uang'] = "IDR";
                            $insertItem[$insertIndex]['nilai_total'] = $data['nilai_total'][$key];
                            $insertItem[$insertIndex]['nilai_ppn'] = $data['nilai_ppn'][$key];
                        }

                        $insertIndex++;
                    }
                }

                $trxItem = BarangKeluarItem::insert($insertItem);
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
    public function destroy(BarangKeluar $barangKeluar)
    {
        try {
            $delete = $barangKeluar->delete();
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
        $barang = Barang::all();
        return view('pages.laporan.barang_keluar.list', compact('barang'));
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
        $barang = $request->barang;
        $barangKeluarItems = BarangKeluarItem::with(['barang', 'barangKeluar', 'gudang'])
            ->whereHas('barangKeluar', function ($query) use ($date1, $date2, $tipe) {
                $query->where('tanggal_bukti', '>=', $date1)
                    ->where('tanggal_bukti', '<=', $date2);
            });
        if ($tipe != 'semua') {
            $barangKeluarItems->whereHas('barangKeluar', function ($query) use ($tipe) {
                $query->where('tipe', $tipe);
            });
        }
        if (!is_null($barang) && $barang != '') {
            $barangKeluarItems->where('barang_uid', $barang);
        }
        $barangKeluarItems = $barangKeluarItems->get()->sortBy(function ($item) {
            return [$item->barangKeluar->tanggal_bukti, $item->barangKeluar->nomor_bukti];
        });

        $total_jumlah = [];
        $total_jumlah_sqm = '0.000';
        $total_bruto = '0.000';
        $total_netto = '0.000';
        $total_nilai = [];
        $total_nilai_ppn = '0.00';
        $total_nilai_total = [];
        foreach ($barangKeluarItems as $key => $value) {
            $jumlah = $value->jumlah;
            $satuan = $value->barang->satuan;
            if (array_key_exists($satuan, $total_jumlah)) {
                $total_jumlah[$satuan] += $jumlah;
            } else {
                $total_jumlah[$satuan] = $jumlah;
            }

            $total_jumlah_sqm += $value->jumlah_sqm;
            $total_bruto += $value->bruto;
            $total_netto += $value->netto;

            $nilai = $value->nilai;
            $mata_uang = $value->mata_uang;
            if (!is_null($nilai) && !is_null($mata_uang)) {
                if (array_key_exists($mata_uang, $total_nilai)) {
                    $total_nilai[$mata_uang] += $nilai;
                } else {
                    $total_nilai[$mata_uang] = $nilai;
                }
            }

            $nilai_ppn = $value->nilai_ppn;
            if (!is_null($nilai_ppn)) {
                $total_nilai_ppn += $nilai_ppn;
            }

            $nilai_total = $value->nilai_total;
            if (!is_null($nilai_total) && !is_null($mata_uang)) {
                if (array_key_exists($mata_uang, $total_nilai_total)) {
                    $total_nilai_total[$mata_uang] += $nilai_total;
                } else {
                    $total_nilai_total[$mata_uang] = $nilai_total;
                }
            }
        }


        ksort($total_jumlah);
        ksort($total_nilai);
        ksort($total_nilai_total);
        $stat = [
            'total_jumlah'      => $total_jumlah,
            'total_jumlah_sqm'  => $total_jumlah_sqm != "0.000" ? $total_jumlah_sqm : null,
            'total_bruto'       => $total_bruto != "0.000" ? $total_bruto : null,
            'total_netto'       => $total_netto != "0.000" ? $total_netto : null,
            'total_nilai'       => $total_nilai,
            'total_nilai_ppn'   => $total_nilai_ppn != "0.00" ? $total_nilai_ppn : null,
            'total_nilai_total' => $total_nilai_total,
        ];

        $from = Utils::formatTanggalIndo($date1);
        $to = Utils::formatTanggalIndo($date2);
        $req_tipe = $tipe;

        return view('pages.laporan.bahan_masuk.print', compact('barangKeluarItems', 'stat', 'from', 'to', 'req_tipe'));
    }

    public function excel_report(Request $request)
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

    public function bdp()
    {
        return view('pages.laporan.bdp.list');
    }

    public function bdp_result_report(Request $request)
    {
        $request->validate([
            'periode' => 'required',
        ]);
        // dd($request->all());
        $periode = explode(' - ', $request->periode);
        $date1 = date('Y-m-d', strtotime($periode[0]));
        $date2 = date('Y-m-d', strtotime($periode[1]));
        $from = Utils::formatTanggalIndo($date1);
        $to = Utils::formatTanggalIndo($date2);

        return view('pages.laporan.bdp.print', compact('from', 'to'));
    }

    public function bdp_excel_report(Request $request)
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
