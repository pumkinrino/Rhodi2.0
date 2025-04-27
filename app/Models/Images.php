<?php

namespace App\Models;
use App\models\users\ProductDetail;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = 'image';
    protected $primaryKey = 'image_id';

    protected $fillable = ['product_code', 'image_url'];

    public $timestamps = false;



}

