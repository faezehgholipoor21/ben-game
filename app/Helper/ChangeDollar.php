<?php

namespace App\Helper;

use App\Models\DollarPrice;

class ChangeDollar
{
    static function change_dollar($price): float|int
    {
        $price = str_replace(",", "", $price);

        $dollar_info = DollarPrice::query()
            ->where('id', 1)
            ->first();

        return $price * $dollar_info['price'];
    }

    static function get_current_dollar()
    {
        $dollar_info = DollarPrice::query()
            ->first();

        return $dollar_info['price'];
    }

}
