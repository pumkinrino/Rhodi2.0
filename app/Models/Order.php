<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $primaryKey = 'order_id';
    public const CREATED_AT = 'order_date';
    public const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'customer_id',
        'shipping_address_id',
        'voucher_id',
        'total_amount',
        'payment_method_id',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'order_date'   => 'datetime',
        'updated_at'   => 'datetime',
        'delivery_date'=> 'datetime',
    ];
}
