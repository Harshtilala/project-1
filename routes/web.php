<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::get('/add-order', [OrderController::class, 'create'])->name('order.create');
Route::post('/orders/store', [OrderController::class, 'store'])->name('order.store');
Route::post('/orders/change-status/{id}', [OrderController::class, 'changeStatus']);
Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('order.edit');
Route::put('/orders/{id}', [OrderController::class, 'update'])->name('order.update');

Route::delete('/`orders/{id}', [OrderController::class, 'destroy'])->name('order.destroy');


Route::get('/item', [ItemController::class, 'index'])->name('item.index');
Route::get('/add-item', [ItemController::class, 'create'])->name('item.create');
Route::post('/items/store', [ItemController::class, 'store'])->name('item.store');
// Route::post('/items/change-status/{id}', [ItemController::class, 'changeStatus']);
Route::get('/items/{id}/edit', [ItemController::class, 'edit'])->name('item.edit');
Route::put('/items/{id}', [ItemController::class, 'update'])->name('item.update');
Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('item.destroy');

// User Routes

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/accounts', [AccountController::class, 'index'])->name('accounts.index');
Route::get('/accounts/create', [AccountController::class, 'create'])->name('accounts.create');
Route::post('/accounts/store', [AccountController::class, 'store'])->name('accounts.store');
Route::get('/accounts/edit/{id}', [AccountController::class, 'edit'])->name('accounts.edit');
Route::put('/accounts/{id}', [AccountController::class, 'update'])->name('accounts.update');
Route::delete('/accounts/delete/{id}', [AccountController::class, 'destroy'])->name('accounts.destroy');

