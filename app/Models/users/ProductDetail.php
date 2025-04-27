<?php

namespace App\Models\users;
use App\Models\users\Product;
use App\Models\Images;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table = 'product_detail';
    protected $primaryKey = 'product_detail_id';

    protected $fillable = [
        'product_id',
        'product_code',
        'dname',
        'description',
        'stock_quantity',
        'size',
        'color',
        'cost',
        'profit_margin',
        'selling_price',
        'status',
        'imported_at'
    ];

    // Liên kết với Product bằng product_id
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
    public function images()
    {
        return $this->hasMany(Images::class, 'product_code', 'product_code');
    }


}

