<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanMasuk extends Model
{
    use HasFactory;
    protected $table = "bahan_masuk";
    protected $primaryKey = 'uid';
    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = [
        'uid',
        'tipe',
        'nomor_bukti',
        'nomor_pib',
        'nomor_po',
        'supplier_uid',
        'kurs',
        'tanggal_bukti',
        'tanggal_pib',
        'tanggal_pib_expire',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'uid' => 'string',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_uid', 'uid');
    }

    public function bahanMasukItems()
    {
        return $this->hasMany(BahanMasukItem::class, 'bahan_masuk_uid', 'uid');
    }
}
