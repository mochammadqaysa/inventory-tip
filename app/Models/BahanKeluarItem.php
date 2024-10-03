<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanKeluarItem extends Model
{
    use HasFactory;
    protected $table = "bahan_keluar_item";
    protected $primaryKey = 'uid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'uid',
        'bahan_keluar_uid',
        'bahan_uid',
        'jumlah',
        'jumlah_kg',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'uid' => 'string',
    ];

    public function bahanKeluar()
    {
        return $this->belongsTo(BahanKeluar::class);
    }

    public function bahan()
    {
        return $this->belongsTo(Bahan::class);
    }
}
