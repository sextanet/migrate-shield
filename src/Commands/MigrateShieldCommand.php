<?php

namespace SextaNet\MigrateShield\Commands;

class MigrateShieldCommand extends Command
{
    public $signature = 'migrate:shield';

    public $description = 'Protects your migrations from being run in production';

    protected $backup_command = 'backup:run';

    protected bool $only_db = true;

    protected bool $disable_notifications = true;

    public string $disk;

    public $password;

    public function __construct()
    {
        parent::__construct();

        $this->setDisk();

        $this->setPassword();
    }

    public function getCommand()
    {
        return $this->backup_command;
    }

    public function getCommandArguments(): array
    {
        $arguments = [];

        if ($this->only_db) {
            $arguments['--only-db'] = true;
        }

        if ($this->disable_notifications) {
            $arguments['--disable-notifications'] = true;
        }

        $arguments['--only-to-disk'] = $this->disk;

        return $arguments;
    }

    public function handle(): int
    {
        $this->migrateShieldEnabled();

        // if (command_exists('mysqldump')) {
        //     $this->commandError('The command "mysqldump" is required to backup your database. Please install or enable it and try again.');

        //     return self::FAILURE;
        // }

        // $this->commandInfo('Running backup before running migrations');

        $this->call($this->getCommand(), $this->getCommandArguments());

        return self::SUCCESS;
    }

    public function setDisk(): void
    {
        $this->disk = config('migrate-shield.disk');

        config()->set('backup.backup.destination.disks', [$this->disk]);
    }

    public function setPassword(): void
    {
        $this->password = config('migrate-shield.password');

        config()->set('backup.backup.password', $this->password);
    }
}
