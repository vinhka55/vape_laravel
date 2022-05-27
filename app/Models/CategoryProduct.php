<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;
    protected $table='category_product';
    public function subCategoryProducts()
    {
        return $this->hasMany('App\Models\SubCategoryProduct');
    }
    public function product()
    {
        return $this->hasMany('App\Models\Product','category');
    }
}
