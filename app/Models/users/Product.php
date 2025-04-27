<?php

namespace App\Models\users;
use App\Models\users\ProductDetail;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'product_id';

    protected $fillable = ['pname', 'category_id', 'brand_id', 'status', 'main_image'];

    // Quan hệ ngược: Sản phẩm thuộc về một danh mục
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
    
    public function productDetail()
    {
        return $this->hasMany(ProductDetail::class, 'product_id', 'product_id');
    }

}
