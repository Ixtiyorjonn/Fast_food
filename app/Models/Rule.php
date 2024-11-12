<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rule extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user_rule(): BelongsTo
    {
        return $this->belongsTo(User_Rule::class);
    }
}
