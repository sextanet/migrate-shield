<?php

namespace SextaNet\MigrateShield;

use Illuminate\Support\Facades\Http;

class MigrateShield
{
    public static function getShareCountUrl(): string
    {
        return config('migrate-shield.share_url')
            ?? 'https://sextanet.com/api/packages/migrate-shield/share';
    }

    public static function shareCount()
    {
        Http::globalRequestMiddleware(fn ($request) => $request->withHeader(
            'User-Agent', 'Migrate Shield'
        ));

        return Http::post(self::getShareCountUrl(), [
            'count' => read_count(),
            'php_version' => phpversion(),
            'laravel_version' => app()->version(),
        ]);
    }
}
