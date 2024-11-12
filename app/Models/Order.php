<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pay_type(): BelongsTo
    {
        return $this->belongsTo(Pay_Type::class);
    }

    public function order_product(): BelongsTo
    {
        return $this->belongsTo(Order_Product::class);  // 'user_id' is the foreign key by default
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
   
}
