<?php

namespace SextaNet\MigrateShield\Commands;

use Illuminate\Console\Command;

class ShieldCheckCommand extends Command
{
    public $signature = 'shield:check';

    public $description = 'Checks configuration for Migrate Shield';

    protected $backupCommand = 'shield:check';
    
    protected $checks = [
        'disk_exists' => false,
    ];

    public function handle(): int
    {
        $this->info('Checking shield configuration...');

        $disk = config('migrate-shield.disk');

        $this->newLine();

        $this->info('Disk: '.$disk);

        $this->newLine();
        
        $this->checkDiskExists($disk);

        if ($this->checkValidConfiguration()) {
            $this->newLine();
            $this->info('✅ Configuration is valid');

            return self::SUCCESS;
        }

        $this->newLine();
        $this->error('🔴 Configuration is invalid');

        return self::FAILURE;
    }

    public function checkValidConfiguration(): bool
    {
        return collect($this->checks)->every(fn ($check) => $check);
    }

    public function checkDiskExists($disk): bool
    {
        if (! in_array($disk, array_keys(config('filesystems.disks')))) {
            $this->error('🔴 Disk "'.$disk.'" not found in filesystems configuration');
            
            return false;
        }

        $this->checks['disk_exists'] = true;

        $this->info('✅ Disk "'.$disk.'" found in filesystems configuration');

        return true;
    }
}
