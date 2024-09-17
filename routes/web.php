<?php

use App\Http\Controllers\Backend\BlogsController;
use App\Http\Controllers\Backend\ProductsController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PagesControler;
use App\Http\Controllers\PersonelsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SlidersController;
use App\Http\Controllers\SlogansController;
use App\Http\Controllers\SSSController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::view('/','backend.home.index')->name('backend.home');

Route::prefix('settings')->group(function(){
Route::get('',[SettingsController::class,'index'])->name('settings.home');
Route::get('edit/{id}',[SettingsController::class,'edit'])->name('settings.edit');
Route::post('update/{id}',[SettingsController::class,'update'])->name('settings.update');

});
Route::resource('products', ProductsController::class);
Route::post('products/sortable',[ProductsController::class,'sortable'])->name('products.sortable');
Route::post('products/switch/{id}',[ProductsController::class,'switch']);
Route::resource('blogs', BlogsController::class);
Route::post('blogs/sortable',[BlogsController::class,'sortable'])->name('blogs.sortable');
Route::post('blogs/switch/{id}',[BlogsController::class,'switch']);
Route::resource('sliders',SlidersController::class);
Route::resource('categories',CategoriesController::class);
Route::resource('types',TypesController::class);
Route::resource('wishlists',WishlistController::class);
Route::resource('videos',VideosController::class);
Route::resource('slogans',SlogansController::class);
Route::resource('services',ServicesController::class);
Route::resource('sss',SSSController::class);
Route::resource('personels',PersonelsController::class);
Route::resource('members',MembersController::class);
Route::resource('customers',CustomersController::class);
Route::resource('pages',PagesControler::class);
Route::resource('orders',OrdersController::class);
Route::resource('menus',MenusController::class);
Route::resource('messages',MessagesController::class);
