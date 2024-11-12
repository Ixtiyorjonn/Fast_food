<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SubCategory::where('active', true)->get();
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
        if (!$this->check('sub_category', 'add')) 
        {
            return response()->json([
                "message" => "sizda bunday huquq yo'q!"
            ]);
        }

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('sub_category_photos', 'public');
           
        }

        SubCategory::create([
            'name' => $request->name,
            'photo_url' => $photoPath ? $photoPath : null, 
            'category_id' => $request->category_id,
        ]);

        return response()->json([
            "message" => "category muvaffaqqiyatli qo'shildi"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        if (!$this->check('sub_category', 'update')) 
        {
            return response()->json([
                "message" => "sizda bunday huquq yo'q!"
            ]);
        }
        
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('sub_category_photos', 'public');
        }

        $subCategory->update([
            'name' => request('name', $subCategory->name),
            'photo_url' => $photoPath ? $photoPath : $subCategory->photo_url,
            'category_id' => request('category_id', $subCategory->category_id)
        ]);

        return response()->json([
            "message" => "category muvaffaqqiyatli o'zgartirildi"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        if (!$this->check('sub_category', 'delete')) 
        {
            return response()->json([
                "message" => "sizda bunday huquq yo'q!"
            ]);
        }

      $subCategory->update(['active'=>!$subCategory->active]);

        return response()->json([
            "message" =>$subCategory->active ?  "category muvaffaqqiyatli arxivdan chiqarildi" :  "category muvaffaqqiyatli arxivlandi"  
        ]);


    }
}
