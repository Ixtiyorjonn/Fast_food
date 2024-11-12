<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function order(): HasOne
    {
        return $this->hasOne(Order::class);  // 'user_id' is the foreign key by default
    }

    public function pay_type(): HasMany
    {
        return $this->hasMany(Pay_Type::class);
    }
}
