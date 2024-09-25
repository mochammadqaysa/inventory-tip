<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $table = "barang_masuk";
    protected $primaryKey = 'uid';

    protected $fillable = [
        'uid',
        'gudang_uid',
        'nomor_bukti',
        'tanggal_bukti',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'uid' => 'string',
    ];

    public function gudang()
    {
        return $this->belongsTo(Gudang::class);
    }

    public function barangMasukItems()
    {
        return $this->hasMany(BarangMasukItem::class);
    }
}
