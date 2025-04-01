<?php

namespace App\Helper;

class WalletTypeTitle
{
    static function wallet_type_title($type_id): array
    {
        if ($type_id == 1) {
            $type_title =  '+ ' . 'افزودن به کیف پول';
            $type_color = 'text-success';
        } else if ($type_id == 0) {
            $type_title = '- ' . 'برداشت از کیف پول';
            $type_color = 'text-danger';
        }
        return [$type_title, $type_color];
    }
}
