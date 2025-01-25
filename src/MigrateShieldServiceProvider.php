<?php

namespace SextaNet\MigrateShield;

use SextaNet\MigrateShield\Commands\MigrateFreshCommand;
use SextaNet\MigrateShield\Commands\MigrateShieldCommand;
use SextaNet\MigrateShield\Commands\ShieldCheckCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MigrateShieldServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('migrate-shield')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_migrate_shield_table')
            ->hasCommand(MigrateShieldCommand::class)
            ->hasCommand(MigrateFreshCommand::class)
            ->hasCommand(ShieldCheckCommand::class);
    }
}
