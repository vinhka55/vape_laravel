<?php

use Illuminate\Support\Facades\Route;
use App\Models\CategoryProduct;
use App\Models\SubCategoryProduct;
use App\Http\Middleware\AdminValid;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// User Interface
Route::get('/', function () {
    $categoryProduct=CategoryProduct::all();
    $subCategoryProduct=SubCategoryProduct::all();
    return view('user.home.home',compact('categoryProduct','subCategoryProduct'));
})->name('home');

//collections
Route::prefix('collections')->group(function(){
    Route::get('/','App\Http\Controllers\CollectionsController@index')->name('index_collections');
    Route::get('/all','App\Http\Controllers\CollectionsController@alls')->name('all_product');
    Route::get('/{slug}','App\Http\Controllers\CollectionsController@product_with_category')->name('show_product_with_category');
});

//products
Route::prefix('products')->group(function(){
    Route::get('/{slug}','App\Http\Controllers\ProductController@detail')->name('detail_product');
});

// cart 
Route::post('/gio-hang','App\Http\Controllers\CartController@show')->name('show_cart');
Route::post('/xoa-san-pham-trong-gio-hang','App\Http\Controllers\CartController@delete_product')->name('delete_product_in_cart');
Route::get('/dem-san-pham-trong-gio-hang','App\Http\Controllers\CartController@countItemCart')->name('count_item_cart');

//checkout
Route::get('/thanh-toan','App\Http\Controllers\CheckoutController@checkout')->name('checkout');
Route::post('/thank-you','App\Http\Controllers\CheckoutController@success')->name('checkout_success');

// address 
Route::post('/chon-huyen','App\Http\Controllers\LocationController@choose_address')->name('choose_address');
Route::post('/chon-xa','App\Http\Controllers\LocationController@choose_ward')->name('choose_ward');

// account action 
Route::get('/dang-nhap','App\Http\Controllers\AccountController@login')->name('login');
Route::post('/xu-ly-dang-nhap','App\Http\Controllers\AccountController@handle_login')->name('handle_login');
Route::post('/dang-ki','App\Http\Controllers\AccountController@register')->name('register');
Route::get('/dang-xuat','App\Http\Controllers\AccountController@logout')->name('logout');
Route::get('/profile','App\Http\Controllers\AccountController@profile')->name('profile')->middleware('userValid');


//Admin Interface
Route::prefix('admin')->group(function(){
    //login logout
    Route::get('/login','App\Http\Controllers\AccountController@adminLogin')->name('adminLogin');
    Route::post('/handle-login','App\Http\Controllers\AccountController@handleAdminLogin')->name('handle_login_admin');
    Route::get('/logout','App\Http\Controllers\AccountController@logoutAdmin')->name('adminLogout');
});
Route::group(['prefix'=>'admin','middleware'=>['adminValid']],function(){
    //dashboard
    Route::get('/','App\Http\Controllers\DashboardController@home')->name('dashboard');

    //category product
    Route::get('/them-danh-muc-san-pham','App\Http\Controllers\CategoryProductController@add')->name('add_category_product');
    Route::post('/xu-ly-them-danh-muc-san-pham','App\Http\Controllers\CategoryProductController@handle_add')->name('handle_add_category_product');
    Route::get('/danh-muc-san-pham','App\Http\Controllers\CategoryProductController@list')->name('list_category_product');
    Route::post('/xoa-danh-muc-san-pham','App\Http\Controllers\CategoryProductController@delete')->name('delete_category_product');
    Route::post('/doi-ten-danh-muc-san-pham','App\Http\Controllers\CategoryProductController@edit_name')->name('edit_name_category_product');

    //sub category product 
    Route::get('/them-danh-muc-con-san-pham','App\Http\Controllers\SubCategoryProductController@add')->name('add_sub_category_product');
    Route::post('/xu-ly-them-danh-muc-con-san-pham','App\Http\Controllers\SubCategoryProductController@handle_add')->name('handle_add_sub_category_product');
    Route::get('/danh-muc-con-san-pham','App\Http\Controllers\SubCategoryProductController@list')->name('list_sub_category_product');
    Route::post('/xoa-danh-muc-con-san-pham','App\Http\Controllers\SubCategoryProductController@delete')->name('delete_sub_category_product');
    Route::post('/doi-ten-danh-muc-con-san-pham','App\Http\Controllers\SubCategoryProductController@edit_name')->name('edit_name_sub_category_product');

    // product 
    Route::get('/them-san-pham','App\Http\Controllers\ProductController@add')->name('add_product');
    Route::post('/xu-ly-them-san-pham','App\Http\Controllers\ProductController@handle_add')->name('handle_add_product');
    Route::get('/danh-sach-san-pham','App\Http\Controllers\ProductController@list_product')->name('list_product');
    Route::get('/xoa-san-pham','App\Http\Controllers\ProductController@delete_product')->name('delete_product');

    //order
    Route::get('/danh-sach-don-hang','App\Http\Controllers\OrderController@list')->name('list_order');
    Route::get('/chi-tiet-don-hang/{id}','App\Http\Controllers\OrderController@order_detail')->name('order_detail');

    //choose category   
    Route::post('/chon-danh-muc-cha','App\Http\Controllers\ProductController@choose_category')->name('choose_category');
    
});