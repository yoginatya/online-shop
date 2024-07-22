<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->group(function () {
//    Route::resource('category', CategoryController::class);
//    Route::resource('product', ProductController::class);
//});

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [UserController::class, 'login'])->name('login');

Route::post('/register', [UserController::class, 'register'])->name('user.register');

Route::post('/logout', [UserController::class, 'logout'])->name('user.logout')->middleware('auth:sanctum');

Route::post('/forgot-password', [UserController::class, 'forgotPassword'])->name('password.email');

Route::get('/reset-password', [UserController::class, 'resetPassword'])->name('password.reset');

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
    
    Route::get('/brands/{id}', [BrandController::class, 'show'])->name('brands.show');
    
    Route::put('/brands/{id}', [BrandController::class, 'update'])->name('brands.update');
    
    Route::delete('brands/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');

