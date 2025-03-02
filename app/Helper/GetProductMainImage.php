<?php

namespace App\Helper;

use App\Models\ImageProduct;
use App\Models\Product;

class GetProductMainImage
{
    static function get_product_main_image($product_id, $asset = false): array|string
    {
        $product_image = Product::query()
            ->where('id', $product_id)
            ->first();


        return $asset ? asset($product_image['product_image']) : $product_image['product_image'];
    }

    static function get_product_images($product_id): array|string
    {
        $product_images_info = ImageProduct::query()
            ->where('product_id', $product_id)
            ->where('is_main', '!=', 1)
            ->count();

        return $product_images_info;
    }


}
