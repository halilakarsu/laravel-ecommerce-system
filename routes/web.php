<?php

use App\Http\Controllers\Backend\BlogsController;
use App\Http\Controllers\Backend\CategoriesController;
use App\Http\Controllers\Backend\MembersController;
use App\Http\Controllers\Backend\MenusController;
use App\Http\Controllers\Backend\MessagesController;
use App\Http\Controllers\Backend\OrdersController;
use App\Http\Controllers\Backend\PagesControler;
use App\Http\Controllers\Backend\PersonelsController;
use App\Http\Controllers\Backend\ProductsController;
use App\Http\Controllers\Backend\ServicesController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\SlidersController;
use App\Http\Controllers\Backend\SlogansController;
use App\Http\Controllers\Backend\SSSController;
use App\Http\Controllers\Backend\TypesController;
use App\Http\Controllers\Backend\CustomersController;
use App\Http\Controllers\Backend\VideosController;
use App\Http\Controllers\Backend\WishlistController;
use Illuminate\Support\Facades\Route;

Route::view('/','backend.home.index')->name('backend.home');
Route::prefix('settings')->group(function(){
Route::get('',[SettingsController::class,'index'])->name('settings.home');
Route::get('edit/{id}',[SettingsController::class,'edit'])->name('settings.edit');
Route::post('update/{id}',[SettingsController::class,'update'])->name('settings.update');
});
//resource kullanarak otomatik crud yöntemlerinden faydalandık.
Route::resource('products', ProductsController::class);
Route::post('products/sortable',[ProductsController::class,'sortable'])->name('products.sortable');
Route::post('products/switch/{id}',[ProductsController::class,'switch']);

//kod tekrarından kurtulmak için aşağıdaki fonksiyonu yazarak tüm routeleri içine ekleyelim

$controllers = [
    'blogs' => BlogsController::class,
    'sliders' => SlidersController::class,
    'categories' => CategoriesController::class,
    'types' => TypesController::class,
    'wishlists' => WishlistController::class,
    'videos' => VideosController::class,
    'slogans' => SlogansController::class,
    'services' => ServicesController::class,
    'sss' => SSSController::class,
    'personels' => PersonelsController::class,
    'members' => MembersController::class,
    'customers' => CustomersController::class,
    'pages' => PagesControler::class,
    'orders' => OrdersController::class,
    'menus' => MenusController::class,
    'messages' => MessagesController::class,
];

    foreach ($controllers as $prefix => $controller) {
        Route::resource($prefix, $controller);
        Route::post("$prefix/sortable", [$controller, 'sortable'])->name("$prefix.sortable");
        Route::post("$prefix/switch/{id}", [$controller, 'switch']);
    }

