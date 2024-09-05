<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\SettingsController;


Route::view('/','backend.home.index')->name('backend.home');
Route::get('/settings',[SettingsController::class,'index'])->name('settings.home');
