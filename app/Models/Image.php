<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'image';
    protected $primaryKey = 'image_id';
    public $timestamps = false;

    protected $fillable = ['product_code', 'image_url'];

    public function productDetail() {
        return $this->belongsTo(ProductDetail::class, 'product_code', 'product_code');
    }
}
