<?php

namespace SextaNet\MigrateShield;

use Illuminate\Support\Facades\Http;

class MigrateShield
{
    public static function getShareCountUrl()
    {
        return 'https://sextanet.com/api/packages/migrate-shield/share';
    }

    public static function shareCount()
    {
        return Http::post(self::getShareCountUrl(), [
            'count' => read_count(),
        ]);
    }
}
