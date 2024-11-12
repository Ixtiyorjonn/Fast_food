<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserRule extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function rule(): HasMany
    {
        return $this->hasMany(Rule::class);
    }

    /**
     * The roles that belong to the User_Rule
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    
}
