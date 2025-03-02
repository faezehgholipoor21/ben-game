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
        'inventory' => 'integer',
        'product_price' => 'float',
    ];

    function categoryInfo(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }

    function accountInfo(): BelongsTo
    {
        return $this->belongsTo(GameAccount::class, 'game_account_id', 'id');
    }

    public function accounts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(GameAccount::class, 'account_product', 'product_id', 'account_id');
    }

}
