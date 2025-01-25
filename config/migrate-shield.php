<?php

return [
    /* -----------------------------------------------------------------
     |  Migrate Shield Configuration
     | -----------------------------------------------------------------
    */

    'name' => env('APP_NAME', 'shield-backups'),

    'disk' => env('MIGRATE_SHIELD_DISK', 'local'),

    'password' => env('MIGRATE_SHIELD_PASSWORD', null),
];
