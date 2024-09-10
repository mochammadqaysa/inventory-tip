<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisWaste extends Model
{
    use HasFactory;
    protected $table = "jenis_waste";
    protected $primaryKey = 'uid';

    protected $fillable = [
        'uid',
        'nama',
        'kode',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'uid' => 'string',
    ];
}
