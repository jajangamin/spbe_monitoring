<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aplikasi extends Model
{
    use SoftDeletes;
    protected $table = 'Aplikasi';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nama_aplikasi',
        'idunit',
        'link',
        'server',
        'status',
        'idjenis',
        'keterangan'

    ];
}
