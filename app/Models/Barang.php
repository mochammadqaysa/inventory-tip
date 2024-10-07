<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Barang extends Model
{
    use HasFactory;
    protected $table = "barang";
    protected $primaryKey = 'uid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'uid',
        'nama',
        'kode',
        'warna',
        'panjang',
        'lebar',
        'tebal',
        'satuan',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'uid' => 'string',
    ];

    public function getSaldoAwal($range1, $column = 'jumlah')
    {
        // DB::enableQueryLog();
        $masuk = (float) $this->getTotalMasukSampai($range1, $column, '<');
        // dd(DB::getQueryLog());
        $keluar = (float) $this->getTotalKeluarSampai($range1, $column, '<');
        $total = $masuk - $keluar;
        // dd($total);
        // if (abs($total) < 0.01) {
        //     $total = 0.0;
        // }
        return $total;
    }
    public function getTotalMasukSampai($tanggal, $column = 'jumlah', $operator = '<=')
    {
        return DB::table('barang_masuk_item')
            ->join('barang_masuk', 'barang_masuk.uid', '=', 'barang_masuk_item.barang_masuk_uid')
            ->where('barang_masuk_item.barang_uid', "$this->uid")
            ->where('barang_masuk.tanggal_bukti', $operator, $tanggal)
            ->sum($column);
    }

    public function getTotalKeluarSampai($tanggal, $column = 'jumlah', $operator = '<=')
    {
        return DB::table('barang_keluar_item')
            ->join('barang_keluar', 'barang_keluar.uid', '=', 'barang_keluar_item.barang_keluar_uid')
            ->where('barang_keluar_item.barang_uid', "$this->uid")
            ->where('barang_keluar.tanggal_bukti', $operator, $tanggal)
            ->sum($column);
    }

    public function getTotalMasuk($periode, $column = 'jumlah')
    {
        $range = explode(' - ', $periode);
        // DB::enableQueryLog();
        return DB::table('barang_masuk_item')
            ->join('barang_masuk', 'barang_masuk.uid', '=', 'barang_masuk_item.barang_masuk_uid')
            ->where('barang_masuk_item.barang_uid', "$this->uid")
            ->where('barang_masuk.tanggal_bukti', '>=', $range[0])
            ->where('barang_masuk.tanggal_bukti', '<=', $range[1])
            ->sum($column);
        // dd(DB::getQueryLog());
    }

    public function getTotalKeluar($periode, $column = 'jumlah')
    {
        $range = explode(' - ', $periode);
        return DB::table('barang_keluar_item')
            ->join('barang_keluar', 'barang_keluar.uid', '=', 'barang_keluar_item.barang_keluar_uid')
            ->where('barang_keluar_item.barang_uid', "$this->uid")
            ->where('barang_keluar.tanggal_bukti', '>=', $range[0])
            ->where('barang_keluar.tanggal_bukti', '<=', $range[1])
            ->sum($column);
    }
}
