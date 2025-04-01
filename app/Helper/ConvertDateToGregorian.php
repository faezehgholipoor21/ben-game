<?php

namespace App\Helper;

class ConvertDateToGregorian
{
    static function convert_date_to_gregorian($date): string
    {
        $date = explode('/', $date);
        $date = verta()->getGregorian(self::convertDigitsToEnglish($date[0]), self::convertDigitsToEnglish($date[1]), self::convertDigitsToEnglish($date[2]));
        return join('-', $date);
    }

    static function convertDigitsToEnglish($string): array|string
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];

        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);
        return str_replace($arabic, $num, $convertedPersianNums);
    }

    static public function convertDateToJalali($date): string
    {
        return verta($date)->format('j/%B/Y');
    }
}
