<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::get('/invoice/print/{invoiceId}', [InvoiceController::class, 'printInvoice']);

Route::any('/{any}', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::any('supply/{any}', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::any('customer/{any}', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::any('edit-product/{any}', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
