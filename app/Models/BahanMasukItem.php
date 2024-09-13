<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanMasukItem extends Model
{
    use HasFactory;
    protected $table = "bahan_masuk_item";
    protected $primaryKey = 'uid';

    protected $fillable = [
        'uid',
        'bahan_masuk_uid',
        'bahan_uid',
        'gudang_uid',
        'kode_hs',
        'nomor_seri',
        'nomor_lot',
        'jumlah',
        'jumlah_kg',
        'nilai',
        'asuransi',
        'ongkos',
        'mata_uang',
        'nilai_total',
        'fasilitas',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'uid' => 'string',
    ];

    public function bahanMasuk()
    {
        return $this->belongsTo(BahanMasuk::class);
    }

    public function bahan()
    {
        return $this->belongsTo(Bahan::class);
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class);
    }
}
