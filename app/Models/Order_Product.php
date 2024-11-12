<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order_Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function profile(): HasOne
    {
        return $this->hasOne(Order::class);  // 'user_id' is the foreign key by default
    }

    public function product(): HasMany
    {
        return $this->HasMany(Product::class);  // 'user_id' is the foreign key by default
    }
}
