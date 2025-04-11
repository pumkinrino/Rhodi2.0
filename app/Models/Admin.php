<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    // Chỉ định tên bảng
    protected $table = 'admin';

    // Chỉ định khóa chính
    protected $primaryKey = 'admin_id';

    // Các trường được phép gán giá trị hàng loạt
    protected $fillable = [
        'code',
        'full_name',
        'email',
        'phone',
        'address',
        'birth',
        'hire_date',
        'password'
    ];

    // Ẩn trường mật khẩu khi trả về dữ liệu model
    protected $hidden = [
        'password'
    ];

    // Nếu không sử dụng timestamps mặc định, bạn có thể tắt:
    public $timestamps = false;
}
