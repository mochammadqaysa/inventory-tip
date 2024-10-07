<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarItem extends Model
{
    use HasFactory;
    protected $table = "barang_keluar_item";
    protected $primaryKey = 'uid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'uid',
        'barang_keluar_uid',
        'barang_uid',
        'jumlah',
        'jumlah_sqm',
        'bruto',
        'netto',
        'nilai',
        'mata_uang',
        'nilai_ppn',
        'nilai_total',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'uid' => 'string',
    ];

    public function barangKeluar()
    {
        return $this->belongsTo(BarangKeluar::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

}
