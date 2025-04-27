<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'customer'; // Chỉ định bảng
    protected $primaryKey = 'customer_id'; // Khóa chính
    public $timestamps = false; // Nếu không dùng timestamps

    protected $fillable = [
        'customer_id',
        'full_name',
        'email',
        'phone',
        'address',
        'password'
    ];

    protected $hidden = ['password'];

    public function getAuthPassword()
    {
        return $this->password;
    }
}
