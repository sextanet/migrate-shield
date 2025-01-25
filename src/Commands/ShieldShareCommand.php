<?php

namespace SextaNet\MigrateShield\Commands;

use SextaNet\MigrateShield\MigrateShield;

class ShieldShareCommand extends Command
{
    public $signature = 'shield:share';

    public $description = 'Share you current counter with Laravel Shield';

    public function handle(): int
    {
        if ($this->confirm("Do you want to share the counter with Laravel Shield's homepage?", true)) {
            MigrateShield::shareCount();

            $this->commandInfo('You counter was shared successfully. Thank you!');
        }

        return self::SUCCESS;
    }
}
