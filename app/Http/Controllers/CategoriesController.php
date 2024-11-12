<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Category;
use Database\Seeders\CategoriesSeeder;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('active', true)
            ->with(["child_category"])
            ->where('parent_id', null)->get();
        $arr = [];
        $this->recursiveFunction($categories, $arr);

        return $arr;
    }

    public function recursiveFunction($categories, &$arr)
    {
        foreach ($categories as $category) {
            // If the category has no children, add it to the array
            if ($category->child_category->isEmpty()) {
                $arr[] = $category;
            } else {
                // Recursively call the function on child categories
                $this->recursiveFunction($category->child_category, $arr);
            }
        }
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
        if (!$this->check('category', 'add')) {
            return response()->json([
                "message" => "you do not have permission!"
            ]);
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'  // Max 2MB
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('category_photos', 'public');
        }
        Category::create([
            "name" => $request->name,
            "photo_url" => $photoPath
        ]);

        return response()->json([
            "message" => "category created"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        if (!$this->check("category", "update")) {
            return response()->json([
                "message" => "sizda bunday huquq yo'q!"
            ]);
        }
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('category_photos', 'public');
        }
        $category->update([
            "name" => request('name', $category->name),
            "photo_url" => isset($photoPath) ? $photoPath : $category->photo_url
        ]);
        return response()->json([
            "message" => "category updated!"
        ]);

        // if (!$this->check("category", "update")) {
        //     return response()->json([
        //         "message"=>"you do not have permission!"
        //     ]);
        // }
        // $photoPath = null;
        // if ($request->hasFile('photo')) {
        //     $photoPath = $request->file('photo')->store('category_photos', 'public');
        // }
        // $category = Category::where('id', $request->id)->first();

        //  $category->update([
        //     "name" => request('name', $category->name),
        //     "photo_url" => isset($photoPath) ? $photoPath : $category->photo_url
        // ]);
        // return response()->json([
        //     "message"=>"category updated!"
        // ]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (!$this->check("category", "delete")) {
            return response()->json([
                "message" => "sizda bunday huquq yo'q!"
            ]);
        }

        $category->update(['active' => !$category->active]);

        return response()->json([
            "message" => $category->active ? "muvaffaqqliyatli arxivdan chiqarildi!" : "muvaffaqqliyatli arxivlandi!"
        ]);
    }
}
