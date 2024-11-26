<?php

namespace App\Helper;

use App\Models\Product;

class GetProductTitleWithProId
{
    static function get_product_title_with_pro_id($product_id)
    {
        $product_info = Product::query()
            ->where('id',$product_id)
            ->first();

        return  $product_info['product_name'];
    }
}
