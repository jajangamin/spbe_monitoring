<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maplikasi extends Model
{
    use SoftDeletes;
    protected $table = 'Maplikasi';
//    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'idaplikasi',
        'tgl_error',
        'tgl_fix',
        'status',
        'keterangan'

    ];
}
