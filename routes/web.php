<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController; //shortcut 
use App\Http\Controllers\SettingController; 
use App\Http\Controllers\cartController; 
use App\Http\Controllers\CuponController; 
use App\Http\Controllers\SubcategoryController; 


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// practice
// Route::get('/life', function (){
// return view('cart');
// });
// practice


Route::get('/contact', [App\Http\Controllers\HomeController::class, 'honey'])->name('contact');
Route::get('product/details/{product_id}', [App\Http\Controllers\FrontendController::class, 'productdetails'])->name('productdetails');
Route::get('shop', [App\Http\Controllers\FrontendController::class, 'shop'])->name('shop');
Route::get('categorywise/{category_id}', [App\Http\Controllers\FrontendController::class, 'categorywise'])->name('categorywise');
Route::get('cart', [App\Http\Controllers\FrontendController::class, 'cart'])->name('cart');


Route::resource('cupon', CuponController::class);
Route::get('cart/{cupon_name}', [App\Http\Controllers\FrontendController::class, 'cart'])->name('cartcupon');


Route::get('/', [App\Http\Controllers\FrontendController::class, 'home'])->name('honey_home');


Route::get('category', [App\Http\Controllers\CategoryController::class, 'category']);
Route::post('category/post', [App\Http\Controllers\CategoryController::class, 'categorypost']);

// 
Route::get('category/delete/{category_id}', [App\Http\Controllers\CategoryController::class, 'category_delete']);
//{}because of id connect
Route::get('category/all/delete', [App\Http\Controllers\CategoryController::class, 'categoryalldelete']);

Route::get('category/edit/{category_id}', [App\Http\Controllers\CategoryController::class, 'categoryedit']);
Route::post('category/post/edit', [App\Http\Controllers\CategoryController::class, 'categoryeditpost']);
Route::get('category/restore/{category_id}', [App\Http\Controllers\CategoryController::class, 'categoryrestore']);
Route::get('category/force/delete/{category_id}', [App\Http\Controllers\CategoryController::class, 'categoryforce']);


Route::get('product', [ProductController::class, 'product'])->name('product');
Route::post('product/post', [ProductController::class, 'productpost'])->name('productpost');


Route::get('setting', [SettingController::class, 'setting'])->name('setting');
Route::post('setting/post', [SettingController::class, 'settingpost'])->name('settingpost');


Route::post('add/to/cart/{product_id}', [cartController::class, 'addtocart'])->name('addtocart');
Route::get('cart/delete/{cart_id}', [cartController::class, 'cartdelete'])->name('cartdelete');
Route::post('update/cart', [App\Http\Controllers\FrontendController::class, 'updatecart'])->name('updatecart');


Route::get('checkout', [App\Http\Controllers\FrontendController::class, 'checkout'])->name('checkout');
Route::post('checkout/post', [App\Http\Controllers\FrontendController::class, 'checkoutpost'])->name('checkoutpost');


Route::get('subcategory', [SubcategoryController::class, 'subcategory']);
Route::post('subcategory/post', [SubcategoryController::class, 'subcategorypost']);

Route::get('customer/register', [App\Http\Controllers\FrontendController::class, 'customerregister'])->name('customer.register');
Route::post('customer/register/post', [App\Http\Controllers\FrontendController::class, 'customerregisterpost'])->name('customer.register.post');
Route::get('customer/login', [App\Http\Controllers\FrontendController::class, 'customerlogin'])->name('customer.login');

Route::post('customer/login/post', [App\Http\Controllers\FrontendController::class, 'customerloginpost'])->name('customer.login.post');