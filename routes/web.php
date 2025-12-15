<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiamondStockController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\KaratController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StockStatusController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRightsController;
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
Route::delete('/orders/delete/{id}', [OrderController::class, 'destroy'])->name('order.destroy');


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

Route::get('ledger', [LedgerController::class,'index'])->name('ledger.index');
Route::get('ledger/create', [LedgerController::class,'create'])->name('ledger.create');
Route::post('ledger/store', [LedgerController::class,'store'])->name('ledger.store');
Route::get('ledger/edit/{id}', [LedgerController::class,'edit'])->name('ledger.edit');
Route::put('ledger/{id}', [LedgerController::class,'update'])->name('ledger.update');
Route::delete('ledger/delete/{id}', [LedgerController::class,'destroy'])->name('ledger.destroy');

Route::get('diamond-stocks', [DiamondStockController::class, 'index'])->name('diamond_stocks.index');
Route::get('diamond-stocks/create', [DiamondStockController::class, 'create'])->name('diamond_stocks.create');
Route::post('diamond-stocks/store', [DiamondStockController::class, 'store'])->name('diamond_stocks.store');
Route::get('diamond-stocks/edit/{id}', [DiamondStockController::class, 'edit'])->name('diamond_stocks.edit');
Route::put('diamond-stocks/{id}', [DiamondStockController::class, 'update'])->name('diamond_stocks.update');
Route::delete('diamond-stocks/delete/{id}', [DiamondStockController::class, 'destroy'])->name('diamond_stocks.destroy');

// Additional routes can be added here as needed    
Route::get('/karat', [KaratController::class, 'index'])->name('karat.index');
Route::get('/karat/create', [KaratController::class, 'create'])->name('karat.create');
Route::post('/karat/store', [KaratController::class, 'store'])->name('karat.store');
Route::get('/karat/edit/{id}', [KaratController::class, 'edit'])->name('karat.edit');
Route::put('/karat/{id}', [KaratController::class, 'update'])->name('karat.update');
Route::delete('karat/delete/{id}', [KaratController::class, 'destroy'])->name('karat.destroy');

Route::get('/stockstatus', [StockStatusController::class, 'index'])->name('stockstatus.index');
Route::get('/stockstatus/create', [stockstatusController::class, 'create'])->name('stockstatus.create');
Route::post('/stockstatus/store', [stockstatusController::class, 'store'])->name('stockstatus.store');
Route::get('/stockstatus/edit/{id}', [stockstatusController::class, 'edit'])->name('stockstatus.edit');
Route::put('/stockstatus/{id}', [stockstatusController::class, 'update'])->name('stockstatus.update');
Route::delete('stockstatus/delete/{id}', [stockstatusController::class, 'destroy'])->name('stockstatus.destroy');

Route::get('user-rights', [UserRightsController::class, 'index'])->name('user_rights.index');
Route::get('user-rights/create', [UserRightsController::class, 'create'])->name('user_rights.create');
Route::post('user-rights/store', [UserRightsController::class, 'store'])->name('user_rights.store');
Route::get('user-rights/edit/{id}', [UserRightsController::class, 'edit'])->name('user_rights.edit');
Route::put('user-rights/{id}', [UserRightsController::class, 'update'])->name('user_rights.update');
Route::delete('user-rights/delete/{id}', [UserRightsController::class, 'destroy'])->name('user_rights.destroy');