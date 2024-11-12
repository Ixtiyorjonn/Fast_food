<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }

}
