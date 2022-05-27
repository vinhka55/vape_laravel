<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use App\Models\SubCategoryProduct;

class SubCategoryProductController extends Controller
{
    public function add()
    {
        $categoryProducts=CategoryProduct::all();
        return view('admin.subCategoryProduct.add',compact('categoryProducts'));
    }
    public function handle_add(Request $request)
    {
        $subCategory = new subCategoryProduct();
        $subCategory->name = $request->nameSubCategoryProduct;
        $subCategory->slug = $request->nameSlugSubCategoryProduct;
        $subCategory->category_product_id=$request->categoryProduct;
        $subCategory->save();
        return redirect()->route('list_sub_category_product');
    }
    public function list()
    {
        $subCategoryProducts=SubCategoryProduct::all();
        return view('admin.subCategoryProduct.list',compact('subCategoryProducts'));
    }
    public function delete(Request $request)
    {
        $subCategoryProduct=SubCategoryProduct::find($request->id);
        $subCategoryProduct->delete();
    }
    public function edit_name(Request $request)
    {
        $categorySubProduct=SubCategoryProduct::find($request->id);
        $categorySubProduct->name=$request->nameSubCategory;
        $categorySubProduct->slug=$request->slugSubCategory;
        $categorySubProduct->save();
    }
}
