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
        //
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
