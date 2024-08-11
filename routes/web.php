<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Dashboard\IndexController;

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

// Route::middleware(['auth'])->group(function(){

//     Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');
// });


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [IndexController::class, 'index'])->name('admin');

Route::get('/tables', function () {
    return view('tables');
});

Route::get('tracking/show', function () {
    return view('dashboard.tracking');
});

Route::get('tracking', function(){
    $data = [
        [51.509, -0.08],
        [51.503, -0.06],
        [51.51, -0.047]
    ];
    return response()->json($data);
})->name('tracking');


