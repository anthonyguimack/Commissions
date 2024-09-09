<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonoConstancia extends Model
{
    use HasFactory;

    //protected $guarded = [];

    protected $table = 'bono_constancia';
    protected $primaryKey = 'id_bono';

    protected $fillable = [
        'partner_id',
        'partner_name',
        'affiliation_date',
        'points_month1',
        'points_month2',
        'points_month3',
        'points_month4',
        'track_active',
        'premio',
        'status'
    ];


    protected $casts = [
        'affiliation_date' => 'datetime:d-m-Y H:i:s',
    ];
}
