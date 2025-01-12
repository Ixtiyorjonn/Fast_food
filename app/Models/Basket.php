<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Basket extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
