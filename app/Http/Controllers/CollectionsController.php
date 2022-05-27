<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategoryProduct;
use App\Models\CategoryProduct;
use App\Models\Product;

class CollectionsController extends Controller
{
    public function index()
    {
        return view('user.collections.collection');
    }
    public function product_with_category($slug)
    {
        $thisSubCategoryProduct = SubCategoryProduct::where('slug',$slug)->first(); 
        if(!$thisSubCategoryProduct){
            $thisSubCategoryProduct = CategoryProduct::where('slug',$slug)->first(); 
            // $thisSubCategoryProduct = SubCategoryProduct::where('category_product_id ',$thisCategoryProduct)->get(); 
        }
        $idSubCategoryProduct = SubCategoryProduct::where('slug',$slug)->value('id'); 
        if(!$idSubCategoryProduct){
            $idCategoryProduct = CategoryProduct::where('slug',$slug)->value('id'); 
            // $idSubCategoryProduct = SubCategoryProduct::where('category_product_id',$idCategoryProduct)->value('id'); 
            $product = Product::where('category',$idCategoryProduct)->get();
            return view('user.products.product_with_category',compact('thisSubCategoryProduct','product'));
        }
        $product = Product::where('subCategory',$idSubCategoryProduct)->get();
        return view('user.products.product_with_category',compact('thisSubCategoryProduct','product'));
    }
    public function alls()
    {
        $product = Product::all();
        return view('user.products.all',compact('product'));
    }
}
