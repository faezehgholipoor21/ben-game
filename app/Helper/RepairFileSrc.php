<?php

namespace App\Helper;

class RepairFileSrc
{
    static function repair_file_src($src): array|string
    {
        return str_replace('\\', '/', $src);
    }
}
