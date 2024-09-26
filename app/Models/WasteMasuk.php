<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteMasuk extends Model
{
    use HasFactory;
    protected $table = "waste_masuk";
    protected $primaryKey = 'uid';

    protected $fillable = [
        'uid',
        'nomor_bukti',
        'tanggal_bukti',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'uid' => 'string',
    ];

    public function wasteMasukItems()
    {
        return $this->hasMany(WasteMasukItem::class);
    }
}
