<?php

namespace App\Models;
use App\Models\users\ProductDetail;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    // Xác định tên bảng
    protected $table = 'order_detail';

    // Chỉ định khóa chính
    protected $primaryKey = 'order_detail_id';

    // Nếu bảng không có cột timestamps (created_at, updated_at), đặt:
    public $timestamps = false;

    // Cho phép gán hàng loạt các trường được
    protected $fillable = [
        'order_id',
        'product_code',
        'quantity',
        'unit_price',
        'subtotal',
    ];

    // Ép kiểu cho các cột số để Laravel tự chuyển đổi (trong trường hợp này là số thập phân)
    protected $casts = [
        'unit_price' => 'decimal:2',
        'subtotal'   => 'decimal:2',
    ];

    /**
     * Quan hệ: Mỗi chi tiết đơn hàng thuộc về một đơn hàng.
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    /**
     * Quan hệ: Mỗi chi tiết đơn hàng liên kết với 1 sản phẩm (lấy theo product_code).
     */
    public function productDetail()
    {
        return $this->belongsTo(ProductDetail::class, 'product_code', 'product_code');
    }
}
