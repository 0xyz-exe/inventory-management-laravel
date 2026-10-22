<?php
use App\Http\Controllers\{ProfileController, ProductController, SupplierController, StockMovementController};
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/dashboard', fn() => redirect()->route('products.index'))->name('dashboard');
    Route::resource('products', ProductController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::get('/stock', [StockMovementController::class, 'index'])->name('stock.index');
    Route::get('/stock/create', [StockMovementController::class, 'create'])->name('stock.create');
    Route::post('/stock', [StockMovementController::class, 'store'])->name('stock.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
