<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\CategoryProduct;
use App\Models\SubCategoryProduct;
use App\Models\Product;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $categoryProduct=CategoryProduct::withCount('product')->get();
        $subCategoryProduct=SubCategoryProduct::withCount('product')->get();
        $productHome=Product::take(8)->get();
        View::share(['categoryProduct'=>$categoryProduct,'subCategoryProduct'=>$subCategoryProduct,'productHome'=>$productHome]);
        Paginator::useBootstrap();
    }
}
