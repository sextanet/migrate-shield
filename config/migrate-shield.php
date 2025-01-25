<?php

return [
    /* -----------------------------------------------------------------
     |  Migrate Shield Configuration
     | -----------------------------------------------------------------
    */

    'name' => env('APP_NAME', 'shield-backups'),

    'disk' => env('MIGRATE_SHIELD_DISK', 'local'),

    'password' => env('MIGRATE_SHIELD_PASSWORD', null),

    'share_url' => env('MIGRATE_SHIELD_SHARE_URL'),
];
