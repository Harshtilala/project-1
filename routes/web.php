<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
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

Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('order.destroy');


Route::get('/item', [ItemController::class, 'index'])->name('item.index');
Route::get('/add-item', [ItemController::class, 'create'])->name('item.create');
Route::post('/items/store', [ItemController::class, 'store'])->name('item.store');
// Route::post('/items/change-status/{id}', [ItemController::class, 'changeStatus']);
Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('item.destroy');

