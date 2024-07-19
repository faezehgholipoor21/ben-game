<?php

namespace App\Helper;

use App\Models\Product;

class GetProductTitle
{
    static function get_product_title($cat_parent_id): array|string
    {
        $product_info = Product::query()
            ->where('id',$cat_parent_id)
            ->first();

        return  $product_info['product_info'];
    }
}
