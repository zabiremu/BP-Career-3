<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('admin.dashboard');

// Category Routes
Route::get('/categories', [CategoryController::class, 'index'])->name('admin.category.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.category.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('admin.category.store');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
