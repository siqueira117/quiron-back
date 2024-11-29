<?php

namespace App\Helpers;

class Password {
    const __HASH__ = "bf4eedc0712a127b77";

    public static function generate(string $senha): string 
    {
        return sha1(self::__HASH__.$senha);
    }
}