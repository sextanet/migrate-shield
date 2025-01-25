<?php

namespace SextaNet\MigrateShield\Commands;

class MigrateShieldCommand extends Command
{
    public $signature = 'migrate:shield';

    public $description = 'Protects your migrations from being run in production';

    protected $backupCommand = 'backup:run';

    public function getCommand()
    {
        return $this->backupCommand;
    }

    public function getCommandArguments(bool $only_db, $disk): array
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
        $this->enabled();

        if (command_exists('mysqldump')) {
            $this->commandError('The command "mysqldump" is required to backup your database. Please install or enable it and try again.');

            return self::FAILURE;
        }

        $this->commandInfo('Running backup before running migrations');

        $disk = config('migrate-shield.disk');

        $this->commandInfo('Selected disk: '.$disk);

        $this->call($this->getCommand(), $this->getCommandArguments(true, $disk));

        return self::SUCCESS;
    }
}
