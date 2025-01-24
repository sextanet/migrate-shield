<?php

namespace SextaNet\MigrateShield\Commands;

use Illuminate\Console\Command;

class MigrateFreshCommand extends Command
{
    public $signature = 'migrate:fresh {--seed : Run seeders after migrating}';

    public $description = 'Drop all tables and re-run all migrations';

    public array $confirm = [
        'Yes, I know what I am doing',
        'Yes, of course',
        'Yes, I am sure',
        'Yes, I am aware',
        'Yes, I am conscious',
    ];

    public function getYesResponse(): string
    {
        return collect($this->confirm)->random();   
    }

    public function ensureExecutingMigration(): bool
    {
        $option = $this->menu("Migrate Shield enabled 🛡\nYou are in PRODUCTION\n\nDo you want to continue?", [
            'No',
            $this->getYesResponse(),
        ])->disableDefaultItems()->open();

        return $option === 1;
    }

    public function handle(): int
    {
        if ($this->ensureExecutingMigration()) {
            $this->call('migrate:shield');

            $this->call(\Illuminate\Database\Console\Migrations\FreshCommand::class, [
                '--seed' => $this->option('seed'),
                '--force' => true,
            ]);
        }

        return self::SUCCESS;
    }
}
