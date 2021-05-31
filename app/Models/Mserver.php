<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mserver extends Model
{
    use SoftDeletes;
    protected $table = 'mserver';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nama_server',
        'id',
        'nama_server',
        'tgl_error',
        'tgl_fix',
        'keterangan',


    ];
}
