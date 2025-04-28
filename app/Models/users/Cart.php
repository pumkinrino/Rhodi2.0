<?php

namespace App\Models\users;
use App\Models\Customer;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'cart_id';

    protected $fillable = ['customer_id', 'product_code', 'quantity', 'added_at', 'updated_at'];

    public $timestamps = false;

    // Liên kết với ProductDetail qua product_code
    public function productDetail()
    {
        return $this->belongsTo(ProductDetail::class, 'product_code', 'product_code');
    }
    public function customer()
{
    return $this->belongsTo(Customer::class, 'customer_id', 'id');
}

}

