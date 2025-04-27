<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table = 'product_detail';
    protected $primaryKey = 'product_detail_id';
    public $timestamps = false;

    protected $fillable = [
        'product_id', 'product_code', 'dname', 'description', 'stock_quantity',
        'size', 'color', 'cost', 'profit_margin', 'selling_price', 'status', 'imported_at'
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
