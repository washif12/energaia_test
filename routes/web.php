<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user',[App\Http\Controllers\HomeController::class, 'indexUser'])->middleware('user');
Route::get('/supplier', [App\Http\Controllers\HomeController::class, 'indexSupplier'])->name('supplierPage')->middleware('supplier');

Route::post('/order',[App\Http\Controllers\HomeController::class, 'orderProduct'])->name('order');
Route::post('/deliver',[App\Http\Controllers\HomeController::class, 'deliverProduct'])->name('deliver');

/*Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');*/
