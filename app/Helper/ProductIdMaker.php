<?php

namespace App\Helper;

use App\Models\Product;

class ProductIdMaker
{
    static function product_id_maker($product_id): array|string
    {
        return $new_product_id = $product_id + 1000;
    }
}
