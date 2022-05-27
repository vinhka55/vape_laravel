<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryProduct;

class CategoryProductController extends Controller
{
    public function add()
    {
        return view('admin.categoryProduct.add');
    }
    public function handle_add(Request $request)
    {
        $category = new CategoryProduct();
        $category->name = $request->nameCategoryProduct;
        $category->slug = $request->nameSlugCategoryProduct;
        $category->save();
        return redirect()->route('list_category_product');
    }
    public function list()
    {
        $list = CategoryProduct::all();
        return view('admin.categoryProduct.list',compact('list'));
    }
    public function delete(Request $request)
    {
        $categoryProduct=CategoryProduct::find($request->id);
        $categoryProduct->delete();
    }
    public function edit_name(Request $request)
    {
        $categoryProduct=CategoryProduct::find($request->id);
        $categoryProduct->name=$request->nameCategory;
        $categoryProduct->slug=$request->slugCategory;
        $categoryProduct->save();
    }
}
