<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SubCategoryProduct;

class ProductController extends Controller
{
    public function add()
    {
        return view('admin.product.add');
    }
    public function handle_add(Request $request)
    {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/products'), $imageName);     
        $product=new Product();
        $product->name = $request->nameProduct;
        $product->slug = $request->nameSlugProduct;
        $product->price = $request->price;
        $product->origin = $request->origin;
        $product->image = $imageName;
        $product->information = $request->information;
        $product->category = $request->categoryProduct;
        if($request->subCategoryProduct != null){
            $product->subCategory = $request->subCategoryProduct;
        }
        else{
            $product->subCategory = 0;
        }
        $product->save();
    }
    public function detail($slug)
    {
        $product = Product::where('slug',$slug)->first();
        return view('user.products.detail',compact('product'));
    }
    public function list_product()
    {
        $product = Product::paginate(5);
        return view('admin.product.list',compact('product'));
    }
    public function delete_product(Request $request)
    {
        $product=Product::find($request->id);
        $product->delete();
    }
    public function choose_category(Request $request)
    {
        $subCategory = SubCategoryProduct::where('category_product_id',$request->category)->get();
        $output = "";
        foreach ($subCategory as $item) {
            $output .= '<option value="'.$item->id.'">'.$item->name.'</option>';
        }
        return $output;
    }
}
