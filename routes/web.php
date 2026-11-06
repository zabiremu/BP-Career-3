<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('admin.dashboard');
Route::view('/categories', 'admin.categories.index')->name('admin.category.index');
