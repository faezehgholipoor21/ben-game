<?php

namespace App\Helper;

use App\Models\DollarPrice;

class GetDollar
{
    static function get_dollar()
    {
        $dollar_price = DollarPrice::query()
            ->where('id', 1)
            ->first();

        return $dollar_price['price'];
    }
}
