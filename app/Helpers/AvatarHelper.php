<?php

namespace App\Helpers;

class AvatarHelper {
    public static function generateAvatar($name) {
        return 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&background=random&color=fff';
    }
}
