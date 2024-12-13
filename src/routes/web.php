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
Route::get('/', [ProductController::class, 'products']);  // 商品一覧のトップページ

Route::get('/register', [ProductController::class, 'showRegisterForm']);  // 商品追加フォーム

Route::get('/products', [ProductController::class, 'products'])->name('products');  // 商品一覧のページ

Route::post('/register', [ProductController::class, 'store']);  // 商品の登録処理

Route::get('/products/{productId}', [ProductController::class, 'show'])->name('show');  // 商品詳細ページ

Route::get('/products/{productId}/edit', [ProductController::class, 'showEditForm'])->name('products.edit');  // 商品編集フォーム

Route::post('/products/{productId}/update', [ProductController::class, 'update'])->name('products.update');  // 商品の更新処理

Route::delete('/products/{productId}', [ProductController::class, 'destroy'])->name('products.destroy');  // 商品削除処理
