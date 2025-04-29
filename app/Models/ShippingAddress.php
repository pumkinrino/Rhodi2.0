<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    // Chỉ định tên bảng vì mặc định Laravel sẽ tìm bảng 'shipping_addresses'
    protected $table = 'shipping_address';

    // Chỉ định khóa chính vì mặc định Laravel sử dụng 'id'
    protected $primaryKey = 'address_id';

    // Nếu bạn không sử dụng timestamps, có thể tắt chúng
    public $timestamps = false;

    // Danh sách các trường có thể mass assign
    protected $fillable = [
        'customer_id',
        'full_name',
        'phone',
        'address_line',
        'city',
        'district',
        'postal_code',
        'is_default',
    ];
}
