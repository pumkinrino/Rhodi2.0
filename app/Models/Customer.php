<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Chỉ định tên bảng
    protected $table = 'customer';

    // Chỉ định khóa chính
    protected $primaryKey = 'customer_id';

    // Các trường được phép gán giá trị hàng loạt
    protected $fillable = [
        'customer_id',
        'full_name',
        'email',
        'phone',
        'address',
        'password'
    ];

    // Ẩn trường mật khẩu khi trả về dữ liệu model
    protected $hidden = [
        'password'
    ];

    // Nếu bảng sử dụng cột created_at, updated_at tự động, bạn không cần tắt timestamps.
    // Nếu không dùng, có thể tắt timestamps bằng:
    public $timestamps = false;
}
