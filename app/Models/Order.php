<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $guarded = [];

    function userInfo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    function expertInfo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'review_expert_id', 'id');
    }

    function statusInfo(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class, 'order_status', 'id');
    }

    function orderDetail(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}
