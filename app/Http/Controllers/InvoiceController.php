<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Models\LotInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Invoice::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Auth::user()->name;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $total = 0;
        foreach ($request->items as $item) {
            $product = Product::find($item['id']);
            $LotInfo = LotInfo::find($item['lotId']);
            if ($product->productname !=  $item['name'] && $LotInfo->r_price !=  $item['price']) {
                return [
                    'isAdded' => false,
                    'error' => 'Item not match',
                ];
            }
            if ($item['qty'] * $item['price'] - $item['discount'] == $item['salePrice']) {
                $total += $item['qty'] * $item['price'] - $item['discount'];
            } else {
                return [
                    'isAdded' => false,
                    'error' => 'Item Sale price error',
                ];
            }
        }

        if ($total != $request->subTotal) {
            return [
                'isAdded' => false,
                'error' => 'Item Sub Total error',
            ];
        } elseif ($request->total != $request->subTotal - $request->tDiscount) {
            return [
                'isAdded' => false,
                'error' => 'Item total error',
            ];
        } elseif ($request->total + $request->balance != $request->payAmount) {
            return [
                'isAdded' => false,
                'error' => 'Item payAmount error',
            ];
        }

        $invoice = new Invoice;
        $invoice->sub_total = $request->subTotal;
        $invoice->discount = $request->tDiscount;
        $invoice->total = $request->total;
        $invoice->pay_amount = $request->payAmount;
        $invoice->balance = $request->balance;
        $invoice->customer_id = 1;
        $invoice->user_id = 1;
        $invoice->save();

        foreach ($request->items as $item) {

            $invoiceItem = new InvoiceItem;
            $invoiceItem->product_id = $item['id'];
            $invoiceItem->name = $item['name'];
            $invoiceItem->code = $item['code'];
            $invoiceItem->price = $item['price'];
            $invoiceItem->qty = $item['qty'];
            $invoiceItem->discount = $item['discount'];
            $invoiceItem->sale_price = $item['salePrice'];
            $invoiceItem->lot_info_id = $item['lotId'];
            $invoiceItem->invoice_id = $invoice->id;
            $invoiceItem->save();

            $lot = LotInfo::find($item['lotId']);
            $temp = $lot->qty;
            $lot->qty = $temp - $item['qty'];
            $lot->save();
        }
        return [
            'isAdded' => true,
            'id' => $invoice->id,
            'error' => '',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }

    public function printInvoice($id)
    {
        $invoice = Invoice::find($id);
        $data = $invoice->load('InvoiceItems');
        // $users = $invoice->load('InvoiceItems')->get();
        // dd($users->toArray());
        // print_r($data);
        // return View('invoices.show')->with('data', $data);
        return View('print.invoice')->with('data', $data);
    }
}
