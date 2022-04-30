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
use App\Http\Controllers\SupplierInvoiceController;
use App\Http\Controllers\StartingCashController;
use App\Http\Controllers\CashInOutController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\DB;
use App\Models\LotInfo;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\SupplierInvoice;
use App\Models\CashInOut;
use Carbon\Carbon;
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

Route::get('/analytics', function () {
    $data = [];
    $day = DB::table('invoices')
        ->whereYear('created_at', Carbon::now()->year)
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereDay('created_at', Carbon::now()->day)
        ->sum('total');

    $data += ['day' => $day];

    $month = DB::table('invoices')
        ->whereYear('created_at', Carbon::now()->year)
        ->whereMonth('created_at', Carbon::now()->month)
        ->sum('total');
    $data += ['month' => $month];

    $year = DB::table('invoices')
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('total');
    $data += ['year' => $year];

    return  $data;
});

Route::get('/product-info/{id}', function ($id) {
    return LotInfo::all()->where('product_id', $id);
});

Route::get('/supplyinvoice/{id}', function ($id) {
    return SupplierInvoice::where('supplier_id', $id)->get();
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

Route::get('/productsupply/{id}', function ($id) {
    return Product::where('supplier_id', $id)->with('category', 'subCategory')->get();
});

Route::get('/lowproduct/{id}', function ($id) {
    return Product::where('supplier_id', $id)->with('lotInfos')->get();
});

Route::get('/lowproduct', function () {
    return Product::with('lotInfos', 'supplier', 'category', 'subCategory')->get();
});

Route::get('/cinvoice/{id}', function ($id) {
    return Invoice::where('customer_id', $id)->get();
});

Route::post('/cusedit', function (Request $request) {
    $customer = Customer::find($request->id);
    $customer->name = $request->name;
    $customer->phone_number = $request->number;
    $customer->description = $request->description;
    $customer->save();
    return true;
});

Route::get('/invoice-payment/{id}', function ($id) {
    $supplierInvoice = SupplierInvoice::find($id);
    $supplierInvoice->is_paid = '1';
    $supplierInvoice->save();
    return true;
});

Route::get('/cinvoice-payment/{id}', function ($id) {
    $invoice = Invoice::find($id);
    $invoice->is_paid = '1';
    $invoice->paid_at = Carbon::now();

    $invoice->save();
    return true;
});

Route::get('/supplylot/{id}', function ($id) {
    return LotInfo::where('supplier_invoice_id', $id)->with('product')->get();
});

Route::post('supplierup', function (Request $request) {
    $supplier = Supplier::find($request->id);
    $supplier->name = $request->name;
    $supplier->company = $request->company;
    $supplier->phone_number = $request->phone_number;
    $supplier->save();
    return true;
});

Route::get('/lastGrn', function () {
    return SupplierInvoice::latest()->first();
});

Route::post('/grnReport', function (Request $request) {
    return SupplierInvoice::where('updated_at', '>=', $request->grnsdate)->where('updated_at', '<=', $request->grnedate)->with('supplier')->get();
});

Route::post('/salesReport', function (Request $request) {
    return Invoice::where('updated_at', '>=', $request->ssdate)->where('updated_at', '<=', $request->sedate)->with('customer')->get();
});

Route::post('/cioreport', function (Request $request) {
    return CashInOut::where('updated_at', '>=', $request->csdate)->where('updated_at', '<=', $request->cedate)->get();
});

Route::post('/returnqty', function (Request $request) {
    $invoiceItem = InvoiceItem::find($request->id);
    $temqty = $invoiceItem->qty;
    $invoiceItem->qty = $temqty - $request->qty;
    $temrqty = $invoiceItem->rqty;
    $invoiceItem->rqty = $temrqty + $request->qty;
    $temstotal =  ($invoiceItem->qty * $invoiceItem->price) - $invoiceItem->discount;
    if ($temstotal < 0) {
        $temstotal = 0;
    }
    $invoiceItem->sale_price = $temstotal;
    $invoiceItem->save();

    $lotInfo = LotInfo::find($invoiceItem->lot_info_id);
    $templqty = $lotInfo->qty;
    $lotInfo->qty = $templqty + $request->qty;
    $lotInfo->save();

    $invoice = Invoice::find($invoiceItem->invoice_id);
    $temtotal = $invoice->total;
    $tempftotal = $temtotal - ($request->qty * $invoiceItem->price);
    if ($tempftotal < 0) {
        $tempftotal = 0;
    }
    $invoice->total = $tempftotal;
    $invoice->save();
    return true;
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
    'supplier-invoice' => SupplierInvoiceController::class,
    'cashinout' => CashInOutController::class,
    'startingcashes' => StartingCashController::class
]);
