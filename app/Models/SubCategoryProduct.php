<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoryProduct extends Model
{
    use HasFactory;
    protected $table='sub_category_product';
    public function categoryProduct()
    {
        return $this->belongsTo('App\Models\CategoryProduct');
    }
    public function product()
    {
        return $this->hasMany('App\Models\Product','subCategory');
    }
    
}
