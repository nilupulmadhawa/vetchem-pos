<?php

namespace App\Http\Controllers;

use App\Models\SupplierInvoice;
use App\Models\LotInfo;
use Illuminate\Http\Request;

class SupplierInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $supplierInvoice = new SupplierInvoice;
        $supplierInvoice->id  = $request->id;
        $supplierInvoice->s_invoice_no  = $request->inviceId;
        $supplierInvoice->note = $request->note;
        $supplierInvoice->total = $request->total;
        $supplierInvoice->is_paid = $request->is_paid;
        $supplierInvoice->issue_at = $request->date;
        $supplierInvoice->supplier_id = $request->supId;
        $supplierInvoice->save();

        foreach ($request->items as $item) {
            $lotInfo = new LotInfo;
            $lotInfo->initial_qty = $item['qty'];
            $lotInfo->qty = $item['qty'];
            $lotInfo->mfd = $item['mfd'];
            $lotInfo->exp = $item['exp'];
            $lotInfo->cost = $item['cost'];
            $lotInfo->r_price = $item['rprice'];
            $lotInfo->ws_price = $item['wprice'];
            $lotInfo->product_id = $item['id'];
            $lotInfo->supplier_invoice_id = $supplierInvoice->id;
            $lotInfo->save();
        }
        return [
            'isAdded' => true,
            'error' => '',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupplierInvoice  $supplierInvoice
     * @return \Illuminate\Http\Response
     */
    public function show($supplierInvoice)
    {
        return SupplierInvoice::find($supplierInvoice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupplierInvoice  $supplierInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(SupplierInvoice $supplierInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SupplierInvoice  $supplierInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupplierInvoice $supplierInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupplierInvoice  $supplierInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplierInvoice $supplierInvoice)
    {
        //
    }
}
