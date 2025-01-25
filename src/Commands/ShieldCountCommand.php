<?php

namespace SextaNet\MigrateShield\Commands;

use SextaNet\MigrateShield\MigrateShield;

class ShieldCountCommand extends Command
{
    public $signature = 'shield:count';

    public $description = 'Shows how many times Migrate Shield has protected you';

    protected $backupCommand = 'shield:count';

    public function handle(): int
    {
        $this->commandInfo("We've protected you ".singular_or_plural(read_count(), 'time', 'times'));

        if ($this->confirm("Do you want to share the counter with Laravel Shield's homepage?", true)) {
            MigrateShield::shareCount();

            $this->commandInfo('You counter was shared successfully');
        }

        return self::SUCCESS;
    }
}
