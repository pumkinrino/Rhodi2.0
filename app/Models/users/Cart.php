<?php

namespace App\Models\users;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // Khai báo bảng và khóa chính nếu tên khác với convention
    protected $table = 'cart';
    protected $fillable = ['product_code', 'quantity'];

    // Định nghĩa quan hệ: Một danh mục có nhiều sản phẩm
    public function products()
    {
        // Tham số thứ nhất: Model Product  
        // Tham số thứ hai: Tên trường khóa ngoại trong bảng products  
        // Tham số thứ ba: Tên trường khóa chính trong bảng category
        return $this->hasMany(Product::class, 'category_id', 'category_id');
        
    }
}
