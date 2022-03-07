<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LotInfoController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\DB;
use App\Models\LotInfo;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/product-info/{id}', function ($id) {
    return LotInfo::all()->where('product_id', $id);
});

Route::resources([
    'product' => ProductController::class,
    'lot-info' => LotInfoController::class,
    'invoice' => InvoiceController::class,
]);
