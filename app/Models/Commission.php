<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    //protected $guarded = [];

    protected $table = 'commissions';
    //protected $primaryKey = 'id';

    protected $fillable = [
        'partner_id',
        'partner_name',
        'amp',
        'active_directories_required',
        'minimal_group_activation',
        'personal_discount',
        'profit_1_level',
        'profit_2_level',
        'period',
        'range',
        'status'
    ];

    protected $casts = [
        'updated_at' => 'datetime:d-m-Y H:i:s',
        
    ];
}
