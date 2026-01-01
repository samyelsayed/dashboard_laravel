<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
use HasFactory;

    // أضف كل الحقول التي تظهر في Postman هنا
    protected $fillable = [
        'name_en', 
        'name_ar', 
        'price', 
        'code', 
        'quantaty', 
        'desc_en', 
        'desc_ar', 
        'status', 
        'subcategory_id', 
        'brand_id', 
        'image'
    ];
}
