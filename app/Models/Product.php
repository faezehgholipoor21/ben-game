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

    public function get_discounted_price()
    {
        $discount = Discount::where('status', 1)
            ->where(function ($query) {
                $query->whereNull('category_id')
                    ->orWhere('category_id', $this->category_id);
            })
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        if ($discount) {
            $discountPercentage = $discount->percentage;
            return $this->price - ($this->price * ($discountPercentage / 100));
        }

        return $this->price;
    }
    //TODO Example For usage Get productswith General dicscount
//    public function index()
//    {
//        $products = Product::with('category')->get();
//
//
//        $productsWithDiscount = $products->map(function ($product) {
//            return [
//                'id' => $product->id,
//                'name' => $product->name,
//                'original_price' => $product->price,
//                'discounted_price' => $product->getDiscountedPrice(),
//                'category' => $product->category ? $product->category->name : 'بدون دسته‌بندی',
//            ];
//        });
//
//        return view('products.index', compact('productsWithDiscount'));
//    }

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
