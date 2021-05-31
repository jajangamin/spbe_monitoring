<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jaringan extends Model
{
    use SoftDeletes;
    protected $table = 'jaringan';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'opd',
        'ssid',
        'bandwitch',
        'ip',
        'long',
        'lat',
        'password',
        'status',
        'link',
        'sn',
        'router',
    ];
}
