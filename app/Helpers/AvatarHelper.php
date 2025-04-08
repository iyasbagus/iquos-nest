<?php

namespace App\Helpers;

class AvatarHelper
{
    public static function generateAvatar($name)
    {
        $encoded = urlencode($name);
        return "https://api.dicebear.com/9.x/adventurer/svg?seed={$encoded}";
    }
}
