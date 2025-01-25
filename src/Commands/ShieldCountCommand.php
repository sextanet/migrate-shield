<?php

namespace SextaNet\MigrateShield\Commands;

class ShieldCountCommand extends Command
{
    public $signature = 'shield:count';

    public $description = 'Shows how many times Migrate Shield has protected you';

    public function handle(): int
    {
        $this->commandInfo("We've protected you ".get_count_times());

        if (read_count() > 5) {
            $this->call('shield:share');
        }

        return self::SUCCESS;
    }
}
