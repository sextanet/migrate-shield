<?php

namespace SextaNet\MigrateShield\Commands;

use Illuminate\Console\Command as BaseCommand;

abstract class Command extends BaseCommand
{
    public function commandInfo(string $text): void
    {
        $this->components->info('Migrate Shield: '.$text);
    }

    public function commandError(string $text): void
    {
        $this->components->error('Migrate Shield: '.$text);
    }

    public function migrateShieldEnabled(): void
    {
        increment_count();

        $this->components->info('Migrate Shield Enabled 🛡');
    }
}
