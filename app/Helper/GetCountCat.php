<?php

namespace App\Helper;

use App\Models\Category;
use App\Models\Product;

class GetCountCat
{
    static function get_count_cat($cat_id): array|string
    {
        return Category::query()
            ->where('parent',$cat_id)
            ->count();
    }
}
