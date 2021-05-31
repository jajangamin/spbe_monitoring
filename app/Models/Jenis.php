<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jenis extends Model
{
    use SoftDeletes;
    protected $table = 'jenis';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nama_jenis',
        'idkategori',
    ];
}
