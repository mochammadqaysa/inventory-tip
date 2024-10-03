<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteKeluarItem extends Model
{
    use HasFactory;
    protected $table = "waste_keluar_item";
    protected $primaryKey = 'uid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'uid',
        'waste_keluar_uid',
        'waste_uid',
        'jenis',
        'nomor_pib',
        'qty',
        'nomor_packing',
        'jumlah',
        'index',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'uid' => 'string',
    ];

    public function wasteKeluar()
    {
        return $this->belongsTo(WasteKeluar::class);
    }

    public function waste()
    {
        return $this->belongsTo(Waste::class);
    }
}
