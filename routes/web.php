<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Report\CustomerBalanceYearlyController;


Route::get('/', function () { return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// ---------- Customer Pages ----------
Route::get('/customer/new', fn() => view('customer.new'))->name('customer.new');
// Route::get('/customer/manager', fn() => view('customer.manager'))->name('customer.manager');
Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::post('/customers/save', [CustomerController::class, 'save'])->name('customers.save');});


// Reports Sections Start--------------------------------------------
Route::get('/reports/customer-balances-yearly', [CustomerBalanceYearlyController::class, 'index'])->name('reports.customer-balances-yearly');   // hyphen!
Route::get('/reports/customer-balances-yearly/data', [CustomerBalanceYearlyController::class, 'fetchData']) ->name('reports.customer-balances-yearly.data');
// Reports Sections End -------------------------------------------- 
Route::get('/sale/new', function () {return view('sale_orders.new_sale_orders');})->name('sale_orders');
Route::get('/sale/manager', function () { return view('sale_orders.sale_order_manager');})->name('sale_orders_manager');


require __DIR__.'/auth.php';