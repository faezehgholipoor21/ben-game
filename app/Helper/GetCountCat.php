<?php

namespace App\Helper;

use App\Models\Product;

class GetCountCat
{
    static function get_count_cat($cat_id): array|string
    {
        $product_count = Product::query()
            ->where('cat_id',$cat_id)
            ->count();

        return  $product_count;
    }
}
