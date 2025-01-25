<?php

namespace SextaNet\MigrateShield\Commands;

class ShieldCountCommand extends Command
{
    public $signature = 'shield:count';

    public $description = 'Shows how many times Migrate Shield has protected you';

    public function handle(): int
    {
        $this->commandInfo("We've protected you ".singular_or_plural(read_count(), 'time', 'times'));

        if (read_count() > 5) {
            $this->call('shield:share');
        }

        return self::SUCCESS;
    }
}
