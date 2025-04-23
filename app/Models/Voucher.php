<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'voucher';
    protected $primaryKey = 'voucher_id';

    protected $fillable = [
        'code', 'description', 'discount_type', 'discount_value',
        'min_order_value', 'max_discount', 'quantity', 'start_date',
        'end_date', 'is_active'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
