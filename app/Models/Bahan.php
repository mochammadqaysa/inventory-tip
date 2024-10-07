<?php

namespace App\Models;

use App\Helpers\Utils;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bahan extends Model
{
    use HasFactory;

    protected $table = "bahan";
    protected $primaryKey = 'uid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'uid',
        'nama',
        'kode',
        'satuan',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'uid' => 'string',
    ];

    public function getSaldoAwal($range1)
    {
        // DB::enableQueryLog();
        $masuk = (float) $this->getTotalMasukSampai($range1, 'jumlah', '<');
        $keluar = (float) $this->getTotalKeluarSampai($range1, 'jumlah', '<');
        $retur = (float) $this->getTotalReturSampai($range1, 'jumlah', '<');
        $total = ($masuk + $retur) - $keluar;
        if (abs($total) < 0.01) {
            $total = 0;
        }
        return $total;
    }

    public function getTotalMasuk($periode, $column = 'jumlah')
    {
        $range = explode(' - ', $periode);
        // DB::enableQueryLog();
        return DB::table('bahan_masuk_item')
            ->join('bahan_masuk', 'bahan_masuk.uid', '=', 'bahan_masuk_item.bahan_masuk_uid')
            ->where('bahan_masuk_item.bahan_uid', "$this->uid")
            ->where('bahan_masuk.tanggal_bukti', '>=', $range[0])
            ->where('bahan_masuk.tanggal_bukti', '<=', $range[1])
            ->sum($column);
        // dd(DB::getQueryLog());
    }

    public function getTotalKeluar($periode, $column = 'jumlah')
    {
        $range = explode(' - ', $periode);
        return DB::table('bahan_keluar_item')
            ->join('bahan_keluar', 'bahan_keluar.uid', '=', 'bahan_keluar_item.bahan_keluar_uid')
            ->where('bahan_keluar_item.bahan_uid', "$this->uid")
            ->where('bahan_keluar.tanggal_bukti', '>=', $range[0])
            ->where('bahan_keluar.tanggal_bukti', '<=', $range[1])
            ->where('bahan_keluar.transaksi', 'keluar')
            ->sum($column);
    }

    public function getTotalRetur($periode, $column = 'jumlah')
    {
        $range = explode(' - ', $periode);
        return DB::table('bahan_keluar_item')
            ->join('bahan_keluar', 'bahan_keluar.uid', '=', 'bahan_keluar_item.bahan_keluar_uid')
            ->where('bahan_keluar_item.bahan_uid', "$this->uid")
            ->where('bahan_keluar.tanggal_bukti', '>=', $range[0])
            ->where('bahan_keluar.tanggal_bukti', '<=', $range[1])
            ->where('bahan_keluar.transaksi', 'retur')
            ->sum($column);
    }

    public function getTotalMasukSampai($tanggal, $column = 'jumlah', $operator = '<=')
    {
        return DB::table('bahan_masuk_item')
            ->join('bahan_masuk', 'bahan_masuk.uid', '=', 'bahan_masuk_item.bahan_masuk_uid')
            ->where('bahan_masuk_item.bahan_uid', "$this->uid")
            ->where('bahan_masuk.tanggal_bukti', $operator, $tanggal)
            ->sum($column);
    }

    public function getTotalKeluarSampai($tanggal, $column = 'jumlah', $operator = '<=')
    {
        return DB::table('bahan_keluar_item')
            ->join('bahan_keluar', 'bahan_keluar.uid', '=', 'bahan_keluar_item.bahan_keluar_uid')
            ->where('bahan_keluar_item.bahan_uid', "$this->uid")
            ->where('bahan_keluar.tanggal_bukti', $operator, $tanggal)
            ->where('bahan_keluar.transaksi', "keluar")
            ->sum($column);
    }

    public function getTotalReturSampai($tanggal, $column = 'jumlah', $operator = '<=')
    {
        return DB::table('bahan_keluar_item')
            ->join('bahan_keluar', 'bahan_keluar.uid', '=', 'bahan_keluar_item.bahan_keluar_uid')
            ->where('bahan_keluar_item.bahan_uid', "$this->uid")
            ->where('bahan_keluar.tanggal_bukti', $operator, $tanggal)
            ->where('bahan_keluar.transaksi', "retur")
            ->sum($column);
    }
}
