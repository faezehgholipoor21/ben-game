<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $guarded = [];

    protected $casts = [
        'id' => 'integer',
        'inventory' => 'integer'
    ];

    function categoryInfo(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }

    function accountInfo(): BelongsTo
    {
        return $this->belongsTo(GameAccount::class, 'game_account_id', 'id');
    }
}
