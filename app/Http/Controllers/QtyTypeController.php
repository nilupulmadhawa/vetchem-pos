<?php

namespace App\Http\Controllers;

use App\Models\QtyType;
use Illuminate\Http\Request;

class QtyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return QtyType::all();
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
        $qtyType = new QtyType;
        $qtyType->name = $request->name;
        $qtyType->save();
        return [
            'isAdded' => true,
            'error' => '',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QtyType  $qtyType
     * @return \Illuminate\Http\Response
     */
    public function show(QtyType $qtyType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QtyType  $qtyType
     * @return \Illuminate\Http\Response
     */
    public function edit(QtyType $qtyType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QtyType  $qtyType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QtyType $qtyType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QtyType  $qtyType
     * @return \Illuminate\Http\Response
     */
    public function destroy(QtyType $qtyType)
    {
        //
    }
}
