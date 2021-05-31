<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mjaringan extends Model
{
    use SoftDeletes;
    protected $table = 'Mjaringan';
//    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'idjaringan',
        'tgl_error',
        'tgl_fix',
        'status',
        'keterangan'

    ];
}
