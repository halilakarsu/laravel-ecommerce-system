<?php
use App\Http\Controllers\Backend\BlogsController;
use App\Http\Controllers\Backend\CategoriesController;
use App\Http\Controllers\Backend\MembersController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\MessagesController;
use App\Http\Controllers\Backend\OrdersController;
use App\Http\Controllers\Backend\PagesControler;
use App\Http\Controllers\Backend\PersonelsController;
use App\Http\Controllers\Backend\ProductsController;
use App\Http\Controllers\Backend\ServicesController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\SlidersController;
use App\Http\Controllers\Backend\SlogansController;
use App\Http\Controllers\Backend\QuestionsController;
use App\Http\Controllers\Backend\TypesController;
use App\Http\Controllers\Backend\CustomersController;
use App\Http\Controllers\Backend\VideosController;
use App\Http\Controllers\Backend\WishlistController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminHomeController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\SocialController;

Route::get('/',[HomeController::class,'index'])->name('frontend.home');
Route::get('/{menu_slug}',[HomeController::class,'blog'])->name('frontend.blog');
Route::get('/admin',[AdminHomeController::class,'index'])->name('backend.home');
Route::prefix('admin/settings')->group(function(){
Route::get('',[SettingsController::class,'index'])->name('settings.home');
Route::get('edit/{id}',[SettingsController::class,'edit'])->name('settings.edit');
Route::post('update/{id}',[SettingsController::class,'update'])->name('settings.update');
});
//resource kullanarak otomatik crud yöntemlerinden faydalandık.
Route::prefix('admin/')->group(function() {
    Route::resource('/products', ProductsController::class);
    Route::prefix('products/')->group(function() {
    Route::post('sortable', [ProductsController::class, 'sortable'])->name('products.sortable');
    Route::post('switch/{id}', [ProductsController::class, 'switch']);
    Route::get('galery/{id}', [ProductsController::class, 'dropzoneShow'])->name('products.dropzoneShow');
    Route::post('dropzone', [ProductsController::class, 'dropzone'])->name('products.dropzone');
    Route::get('dropzoneDelete/{id}', [ProductsController::class, 'dropzoneDelete'])->name('products.dropzoneDelete');
    });
});
$controllers = [
    'blogs' => BlogsController::class,
    'sliders' => SlidersController::class,
    'categories' => CategoriesController::class,
    'types' => TypesController::class,
    'wishlists' => WishlistController::class,
    'videos' => VideosController::class,
    'slogans' => SlogansController::class,
    'services' => ServicesController::class,
    'questions' => QuestionsController::class,
    'personels' => PersonelsController::class,
    'members' => MembersController::class,
    'customers' => CustomersController::class,
    'pages' => PagesControler::class,
    'orders' => OrdersController::class,
    'menus' => MenuController::class,
    'messages' => MessagesController::class,
    'socials' => SocialController::class,
];

    foreach ($controllers as $prefix => $controller) {
        Route::resource("admin/$prefix", $controller);
        Route::post("admin/$prefix/sortable", [$controller, 'sortable'])->name("$prefix.sortable");
        Route::post("admin/$prefix/switch/{id}", [$controller, 'switch']);
    }

