<?php

namespace SextaNet\MigrateShield\Commands;

use Illuminate\Console\Command;

class MigrateShieldCommand extends Command
{
    public $signature = 'migrate:shield';

    public $description = 'Protects your migrations from being run in production';

    protected $backupCommand = 'backup:run';

    public function getCommand()
    {
        return $this->backupCommand;
    }

    public function getCommandArguments(bool $only_db = true, $disk): array
    {
        $arguments = [];

        if ($only_db) {
            $arguments['--only-db'] = true;
        }
        
        $arguments['--only-to-disk'] = $disk;

        return $arguments;
    }

    public function handle(): int
    {
        $this->newLine();
        $this->warn('------------------------------');
        $this->newLine();
        $this->warn('  You are in production mode  ');
        $this->warn('   Migrate Shield enabled 🛡  ');
        $this->newLine();
        $this->warn('------------------------------');

        if (command_exists('mysqldump')) {
            $this->newLine(2);
            $this->error('The command "mysqldump" is required to backup your database. Please install it and try again.');

            return self::FAILURE;
        }

        $this->info('Running backup before running migrations...');

        $disk = config('migrate-shield.disk');

        $this->info('Selected disk: ' . $disk);

        $this->call($this->getCommand(), $this->getCommandArguments(true, $disk));

        return self::SUCCESS;
    }
}
