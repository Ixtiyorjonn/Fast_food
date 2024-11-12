<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    // protected $table = "categories";
    protected $guarded = [];

    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function child_category(){
        return $this->hasMany(Category::class, "parent_id", "id")
                    ->with(["child_category"]);
    }
}
