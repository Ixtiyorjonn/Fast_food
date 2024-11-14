<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Discount::with(['product'])->select('product_id', 'amount', 'start_time', 'end_time',
                                                 'created_at as yaratilgan vaqti')->get();
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
        if (!$this->check("discount", "add")) 
        {
            return response()->json([
                "message" => "sizda bunday huquq yo'q!"
            ]);
        }

        Discount::create([
            "product_id" => $request->product_id,
            "amount" => $request->amount,
            "start_time" => $request->start_time,
            "end_time" => $request->end_time,
        ]);

        return response()->json([
            "message" => "chegirma muvaffaqqiyatli yaratildi!"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discount $discount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discount $discount)
    {
        if (!$this->check("discount", "update")) 
        {
            return response()->json([
                "message" => "sizda bunday huquq yo'q!"
            ]);
        }

        $discount->update([
            "product_id" => $request->product_id,
            "amount" => $request->amount,
            "start_time" => $request->start_time,
            "end_time" => $request->end_time,
        ]);

        return response()->json([
            "message" => "chegirma muvaffaqqiyatli o'zgartirildi!"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount)
    {
        if (!$this->check("discount", "delete")) {
            return response()->json([
                "message" => "sizda bunday huquq yo'q"
            ]);
        }
        $discount->delete();
        
        return response()->json([
            "message" => "chegirma muvaffaqqiyatli o'chirildi!"
        ]);
    }
}
