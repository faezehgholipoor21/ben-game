<?php

namespace App\Helper;

use App\Models\Category;

class CalculateSubCatCount
{
    static function calculate_sub_cat_count($cat_id): float|int
    {
        return Category::query()
            ->where('parent', $cat_id)
            ->count();
    }
}
