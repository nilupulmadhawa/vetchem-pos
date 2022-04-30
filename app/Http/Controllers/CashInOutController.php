<?php

namespace App\Http\Controllers;

use App\Models\CashInOut;
use Illuminate\Http\Request;

class CashInOutController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CashInOut::all();
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
        $cashInOut = new CashInOut;
        $cashInOut->type = $request->type;
        $cashInOut->amount = $request->amount;
        $cashInOut->description = $request->description;
        $cashInOut->save();
        return [
            'isAdded' => true,
            'error' => '',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashInOut  $cashInOut
     * @return \Illuminate\Http\Response
     */
    public function show(CashInOut $cashInOut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashInOut  $cashInOut
     * @return \Illuminate\Http\Response
     */
    public function edit(CashInOut $cashInOut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CashInOut  $cashInOut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CashInOut $cashInOut)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashInOut  $cashInOut
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashInOut $cashInOut)
    {
        //
    }
}
