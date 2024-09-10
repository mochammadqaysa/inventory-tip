<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    use HasFactory;

    protected $table = "bahan";
    protected $primaryKey = 'uid';

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
}
