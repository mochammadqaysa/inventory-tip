<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "roles";
    protected $primaryKey = 'uid';
    protected $fillable = [
        'uid',
        'name',
        'slug',
        'description',
    ];

    protected $casts = [
        'uid' => 'string',
    ];
}
