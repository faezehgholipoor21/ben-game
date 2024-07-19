<?php

namespace App\Helper;

use App\Models\Category;

class GetCategoryTitle
{
    static function get_category_title($cat_parent_id): array|string
    {
        $category_info = Category::query()
            ->where('id',$cat_parent_id)
            ->first();

        return  $category_info['cat_title'];
    }
}
