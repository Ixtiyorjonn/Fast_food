<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Branches;
use Illuminate\Http\Request;

class BranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Branch::select('branch', 'start_time', 'end_time')->get();
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
        if (!$this->check("branch", "add")) {
            return response()->json([
                "message" => "sizda bunday huquq yo'q!"
            ]);
        }

        Branch::create([
            "branch" => $request->branch,
            "start_time" => $request->start_time,
            "end_time" => $request->end_time,
            "district_id" => $request->district_id,
            "region_id" => $request->region_id,
            "adress" => $request->adress,
        ]);

        return response()->json([
            "message" => "filial muvaffaqqiyatli yaratildi!"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        if (!$this->check("branch", "update")) {
            return response()->json([
                "message" => "sizda bunday huquq yo'q!"
            ]);
        }

        $branch->update([
            "branch" => $request->branch,
            "start_time" => $request->start_time,
            "end_time" => $request->end_time,
            "district_id" => $request->district_id,
            "region_id" => $request->region_id,
            "adress" => $request->adress,
        ]);

        return response()->json([
            "message" => "filial muvaffaqqiyatli o'zgartirildi!"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        //
    }
}
