<?php

namespace App\Http\Controllers;

use App\Models\LotInfo;
use App\Models\CashInOut;
use App\Models\Product;
use Illuminate\Http\Request;



class LotInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LotInfo::all();
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
        $lotInfo = new LotInfo;
        $lotInfo->initial_qty = $request->qty;
        $lotInfo->qty = $request->qty;
        $lotInfo->mfd = $request->mfd;
        $lotInfo->exp = $request->exp;
        $lotInfo->cost = $request->cost;
        $lotInfo->r_price = $request->rprice;
        $lotInfo->ws_price = $request->wprice;
        $lotInfo->product_id = $request->id;
        $lotInfo->save();
        return [
            'isAdded' => true,
            'error' => '',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LotInfo  $lotInfo
     * @return \Illuminate\Http\Response
     */
    public function show($lotInfo)
    {
        return LotInfo::find($lotInfo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LotInfo  $lotInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(LotInfo $lotInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LotInfo  $lotInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LotInfo $lotInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LotInfo  $lotInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lotInfo = LotInfo::find($id);
        $product = Product::find($lotInfo->product_id);

        $cashInOut = new CashInOut;
        $cashInOut->type = 'cashin';
        $cashInOut->amount = $lotInfo->qty * $lotInfo->cost;
        $cashInOut->description = 'Delete product code:' . $product->code . ' /QTY:' . $lotInfo->qty . ' /cost:' . $lotInfo->cost . ' /EXP:' . $lotInfo->exp;
        $cashInOut->save();
        // dd($product);
        $lotInfo->delete();


        return true;
    }
}
