<?php

namespace App\Models\users;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Khai báo bảng và khóa chính nếu tên khác với convention
    protected $table = 'category';
    protected $primaryKey = 'category_id';

    protected $fillable = ['category_name', 'category_detail_name'];

    // Định nghĩa quan hệ: Một danh mục có nhiều sản phẩm
    public function products()
    {
        // Tham số thứ nhất: Model Product  
        // Tham số thứ hai: Tên trường khóa ngoại trong bảng products  
        // Tham số thứ ba: Tên trường khóa chính trong bảng category
        return $this->hasMany(Product::class, 'category_id', 'category_id');
        
    }
}
