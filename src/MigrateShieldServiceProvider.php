<?php

namespace SextaNet\MigrateShield;

use SextaNet\MigrateShield\Commands\MigrateFreshCommand;
use SextaNet\MigrateShield\Commands\MigrateShieldCommand;
use SextaNet\MigrateShield\Commands\ShieldCheckCommand;
use SextaNet\MigrateShield\Commands\ShieldCountCommand;
use SextaNet\MigrateShield\Commands\ShieldShareCommand;
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
            ->hasCommand(ShieldCheckCommand::class)
            ->hasCommand(ShieldCountCommand::class)
            ->hasCommand(ShieldShareCommand::class)
            ->hasCommand(MigrateFreshCommand::class)
            ->hasCommand(MigrateShieldCommand::class);

        $this->app->bind('shield-base-path', function () {
            return realpath(__DIR__.'/../');
        });
    }
}
