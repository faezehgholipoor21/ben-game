<?php

namespace App\Helper;

use App\Models\Config;

class TaxHelper
{
    static function get_tax()
    {
        $config_info = Config::query()
            ->where('key', 'tax')
            ->first();

        if (!$config_info) {
            $config_info = Config::query()->create([
                'tax' => '10',
            ]);
        }

        return $config_info->value;
    }
}
