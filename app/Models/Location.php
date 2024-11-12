<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function branch(): HasMany
    {
        return $this->hasMany(Branch::class);
    }
}
