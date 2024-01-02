<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\IndexController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\SettingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'index'])->name('admin');
Route::group(['as' => 'dashboard.'], function () {
    Route::put('settings/{setting}/update', [SettingController::class, 'update'])->name('settings.update');
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    
    Route::get('categories/ajax', [CategoryController::class, 'getAll'])->name('categories.getall');
    Route::resource('categories', CategoryController::class)->except('destroy','show');
    Route::delete('categories', [CategoryController::class, 'delete'])->name('categories.delete');
    
    Route::resource('products',ProductController::class)->except('show');
    Route::get('products/ajax', [ProductController::class, 'getAll'])->name('products.getall');

});
