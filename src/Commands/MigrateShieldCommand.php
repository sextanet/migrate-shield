<?php

namespace SextaNet\MigrateShield\Commands;

class MigrateShieldCommand extends Command
{
    public $signature = 'migrate:shield';

    public $description = 'Protects your migrations from being run in production';

    protected $backupCommand = 'backup:run';

    public string $disk;

    public function __construct()
    {
        parent::__construct();

        $this->setDisk();
    }

    public function getCommand()
    {
        return $this->backupCommand;
    }

    public function getCommandArguments(bool $only_db): array
    {
        $arguments = [];

        if ($only_db) {
            $arguments['--only-db'] = true;
        }

        $arguments['--only-to-disk'] = $this->disk;

        return $arguments;
    }

    public function handle(): int
    {
        $this->enabled();

        // if (command_exists('mysqldump')) {
        //     $this->commandError('The command "mysqldump" is required to backup your database. Please install or enable it and try again.');

        //     return self::FAILURE;
        // }

        // $this->commandInfo('Running backup before running migrations');

        $this->call($this->getCommand(), $this->getCommandArguments(true));

        return self::SUCCESS;
    }

    public function setDisk(): void
    {
        $this->disk = config('migrate-shield.disk');

        config()->set('backup.backup.destination.disks', [$this->disk]);
    }
}
