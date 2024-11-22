<?php

namespace App\Helper;

use App\Models\ImageProduct;
use App\Models\Product;

class GetProductMainImage
{
    static function get_product_main_image($product_id): array|string
    {
        $product_info = ImageProduct::query()
            ->where('product_id',$product_id)
            ->where('is_main' , 1)
            ->first();

        return  $product_info['image_src'];
    }

    static function get_product_images($product_id): array|string
    {
        $product_images_info = ImageProduct::query()
            ->where('product_id',$product_id)
            ->where('is_main' ,'!=', 1)
            ->count();

        return  $product_images_info;
    }
}
