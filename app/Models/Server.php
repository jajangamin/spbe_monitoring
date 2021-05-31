<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Server extends Model
{
    use SoftDeletes;
    protected $table = 'server';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'nama_server',



    ];
}
