<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    // Chỉ định bảng trong CSDL (bảng payment_method)
    protected $table = 'payment_method';

    // Các trường có thể được gán giá trị
    protected $fillable = [
        'method_name', 
        'description', 
        'status'
    ];

 
    
}
