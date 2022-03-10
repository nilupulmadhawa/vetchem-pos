<?php

namespace App\Http\Controllers;

use App\Models\LotInfo;
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
    public function destroy(LotInfo $lotInfo)
    {
        //
    }
}
