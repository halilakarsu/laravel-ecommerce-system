<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\ProductsController;

Route::view('/','backend.home.index')->name('backend.home');
Route::get('/settings',[SettingsController::class,'index'])->name('settings.home');
Route::get('/settings/edit/{id}',[SettingsController::class,'edit'])->name('settings.edit');
Route::post('/settings/update/{id}',[SettingsController::class,'update'])->name('settings.update');

Route::resource('products', ProductsController::class);
