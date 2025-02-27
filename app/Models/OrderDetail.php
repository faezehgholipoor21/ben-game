<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_detail';
    protected $guarded = [];

    function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
