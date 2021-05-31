<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rawat extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kamar_inap';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kodekamar',
        'typekamar',
        'namakamar',
        'fasilitas',
        'jumlahkamar',
        'biaya',
        'status',
        'created_by' 
    ];

    /**
     * The attributes fields will be Carbon-ized.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

}
