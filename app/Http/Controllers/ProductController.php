<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Barcode;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::with('category', 'subCategory')->get();
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

        // return ($request);
        $product = new Product;
        $product->name = $request->name;
        $product->code = $request->code;
        $product->qty_type = $request->qty_type;
        $product->re_order_level = $request->orderLevel;
        $product->re_order_qty = $request->orderQty;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->category_id  = $request->category;
        $product->sub_category_id  = $request->subCategory;
        $product->brand_id  = $request->brand;
        $product->supplier_id   = $request->supplier;
        $product->save();

        foreach ($request->barcode as $code) {
            $barcode = new Barcode;
            $barcode->barcode = $code;
            $barcode->product_id = $product->id;
            $barcode->save();
        }

        return [
            'isAdded' => true,
            'error' => '',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        return Product::where('id', $product)->get();
        // return Product::find($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
