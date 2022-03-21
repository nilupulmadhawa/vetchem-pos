<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LotInfoController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\QtyTypeController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\DB;
use App\Models\LotInfo;
use App\Models\Category;
use App\Models\Invoice;
use phpDocumentor\Reflection\PseudoTypes\False_;

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

Route::get('/invoiceItem/{id}', function ($id) {
    $invoice = Invoice::find($id);
    return $invoice->load('invoiceItems');
});


Route::get('/category/check/{value}', function ($value) {
    $count = Category::all()->where('name', $value)->count();

    if ($count > 0) {
        return 1;
    } else {
        return 0;
    }
});



Route::resources([
    'product' => ProductController::class,
    'lot-info' => LotInfoController::class,
    'invoice' => InvoiceController::class,
    'category' =>   CategoryController::class,
    'subcategory' => SubCategoryController::class,
    'brand' => BrandController::class,
    'supplier' => SupplierController::class,
    'qtytype' => QtyTypeController::class,
    'customer' => CustomerController::class,
]);
