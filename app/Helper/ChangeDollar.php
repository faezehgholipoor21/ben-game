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

        $new_price = $price * $dollar_info['price'];

        return $new_price;
    }

}
