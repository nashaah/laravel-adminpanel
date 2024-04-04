<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;

//Login routes

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/', [LoginController::class, 'loginPost'])->name('login.post');
Route::match(['get', 'post'], '/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', [DashboardController::class, 'showDashboard'])->name('home');

// Order routes

Route::get('/createorder', [OrderController::class, 'index'])->name('make.order');
Route::get('/orderlist', [OrderController::class, 'show'])->name('view.order');
Route::post('/createorder', [OrderController::class, 'store'])->name('order.store');
Route::post('/createorder/cart', [OrderController::class, 'storeCart'])->name('order.cart');
Route::get('deletes/{id}', [OrderController::class, 'removeRow']);
Route::get('/orderlist/{id}',[OrderController::class,'showDetails']);
Route::get('removeorder/{id}',[OrderController::class,'delete']);
Route::put('orderlist/{id}',[OrderController::class,'updateStatus']);

// Purchase routes

Route::get('/createpurchase', [PurchaseController::class, 'index'])->name('make.purchase');
Route::post('/createpurchase', [PurchaseController::class, 'store'])->name('purchase.store');
Route::post('/createpurchase/cart', [PurchaseController::class, 'storeCart'])->name('purchase.cart');
Route::get('delete/{id}', [PurchaseController::class, 'removeRow']);
Route::get('/purchaselist',[PurchaseController::class,'show'])->name('view.purchase');
Route::get('/purchaselist/{id}',[PurchaseController::class,'showDetails']);
Route::get('remove/{id}',[PurchaseController::class,'delete']);
Route::put('purchaselist/{id}',[PurchaseController::class,'updateStatus']);

View::composer('navbar', function ($view) {
    // Retrieve and share the profile data
    $employeeID = session('employeeID');
    $employee = \App\Models\Employee::where('employeeID', $employeeID)->first();

    // Share the data with the navbar view
    $view->with('employee', $employee);
});



