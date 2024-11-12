<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Product::where('active', true)->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$this->check('product', 'add')) {
            return response()->json([
                "message" => "sizda bunday huquq yo'q!"
            ]);
        }


        Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'on_discount' => $request->on_discount,
                'category_id' => $request->category_id,
                'photo_url' => $request->photo_url,
                'new' => $request->new,
                'duration_time' => $request->duration_time,
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if (!$this->check('product', 'update')) {
            return response()->json([
                "message" => "sizda bunday huquq yo'q!"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (!$this->check('product', 'delete')) {
            return response()->json([
                "message" => "sizda bunday huquq yo'q!"
            ]);
        }
    }
}
