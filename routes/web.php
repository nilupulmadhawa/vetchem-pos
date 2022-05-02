<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\StartingCashController;

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

Route::get('/test', [App\Http\Controllers\StartingCashController::class, 'prestore'])->name('test');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/download', [App\Http\Controllers\DashboardController::class, 'download'])->name('download');
Route::post('/startofdayadd', [App\Http\Controllers\StartingCashController::class, 'store'])->name('startofdayadd');
Route::post('/endofdayadd', [App\Http\Controllers\StartingCashController::class, 'endstore'])->name('endofdayadd');
Route::get('/endofday', [App\Http\Controllers\StartingCashController::class, 'end'])->name('endofday');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/startofday', [App\Http\Controllers\StartingCashController::class, 'create'])->name('startofday');

Route::get('/invoice/print/{invoiceId}', [InvoiceController::class, 'printInvoice']);

Route::any('/{any}', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::any('supply/{any}', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::any('customer/{any}', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::any('edit-product/{any}', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
