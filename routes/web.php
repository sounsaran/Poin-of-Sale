<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\AuthController;


// Login Route 
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

// Register Route
Route::get('/', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);



Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


// Product routes
Route::resource('products', ProductController::class);

// Customer routes
Route::resource('customer', CustomerController::class);

// Category routes
Route::resource('categories', CategoryController::class);

// suppliers routes
Route::resource('suppliers', SupplierController::class);


Route::resource('pos', PosController::class);