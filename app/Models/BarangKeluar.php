<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $table = "barang_keluar";
    protected $primaryKey = 'uid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'uid',
        'customer_uid',
        'tipe',
        'nomor_bukti',
        'tanggal_bukti',
        'nomor_peb',
        'tanggal_peb',
        'ppn',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'uid' => 'string',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function barangKeluarItems()
    {
        return $this->hasMany(BarangKeluarItem::class);
    }
}
