<?php

namespace App\Util;

class OS
{
    public static function isWindows()
    {
        return (strtoupper(substr(php_uname(), 0, 7)) === 'WINDOWS');
    }
}
