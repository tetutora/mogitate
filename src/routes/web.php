<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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
Route::get('/',[ProductController::class,'products']);

Route::get('/register', [ProductController::class, 'showRegisterForm']);

Route::get('/products',[ProductController::class,'products'])->name('products');

Route::post('/register',[ProductController::class,'store']);

Route::get('/products/{productId}', [ProductController::class, 'show'])->name('show');

Route::get('/products/{productId}/update',[ProductController::class,'update']);

Route::post('/products/{productId}/update', [ProductController::class, 'update'])->name('products.update');

Route::delete('/products/{productId}', [ProductController::class, 'destroy'])->name('products.destroy');

