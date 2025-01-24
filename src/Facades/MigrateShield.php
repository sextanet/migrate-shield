<?php

namespace SextaNet\MigrateShield\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SextaNet\MigrateShield\MigrateShield
 */
class MigrateShield extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \SextaNet\MigrateShield\MigrateShield::class;
    }
}
