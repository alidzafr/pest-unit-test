<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\Api\ProductController as ApiProductCtr;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('product', [ProductController::class, 'index'])->middleware('auth')->name('product.index');
Route::get('product/create', [ProductController::class, 'create'])->middleware('role:admin');
Route::post('product/', [ProductController::class, 'store'])->middleware('role:admin');
Route::get('product/edit/{products}', [ProductController::class, 'edit'])->middleware('role:admin');
Route::put('product/edit/{products}', [ProductController::class, 'update'])->middleware('role:admin');
Route::delete('product/delete/{products}', [ProductController::class, 'delete'])->middleware('role:admin');
// Route::get('product/edit/{products}', [ProductController::class, 'edit'])->name('products.edit')->middleware('role:owner');

Route::get('/api/product', [ApiProductCtr::class, 'index']);
Route::post('/api/product', [ApiProductCtr::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
