<?php

use App\Http\Controllers\categories\categoriesController;
use App\Http\Controllers\products\productsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('categories', categoriesController::class);
    Route::resource('products', productsController::class);

    Route::get('/products/{product}', [productsController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [productsController::class, 'edit'])->name('products.edit');
    Route::post('/products', [productsController::class, 'store'])->name('products.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
