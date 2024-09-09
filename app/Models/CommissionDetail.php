<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionDetail extends Model
{
    use HasFactory;

    //protected $guarded = [];

    protected $table = 'commissions_detail';
    //protected $primaryKey = 'id';

    protected $fillable = [
        'commission_id',
        'type',
        'partner_id',
        'partner_name',
        'level',
        'id_order',
        'date_commission',
        'amount',
        'points',
        'percentage',
        'commissions_points',
        'commissions_money'
    ];

    protected $casts = [
        'date_commission' => 'datetime:d-m-Y H:i:s',
        'payment_date' => 'datetime:d-m-Y H:i:s',
        
    ];
}
