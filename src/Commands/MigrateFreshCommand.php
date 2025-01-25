<?php

namespace SextaNet\MigrateShield\Commands;

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

    public array $messages = [
        5 => "We've protected you",
        10 => "Nice! We've protected you",
        20 => "Great! We've protected you",
        40 => 'Cooool! Shield protected you',
        80 => 'Awesome! Shield is doing a great job',
        100 => 'Shield Master!',
    ];

    public function getYesResponse(): string
    {
        return collect($this->confirm)->random();
    }

    public function getTitle(): string
    {
        return "Migrate Shield enabled 🛡\nYou are in PRODUCTION\n\nDo you want to continue?";
    }

    public function getOptions(): array
    {
        return [
            'No',
            $this->getYesResponse(),
        ];
    }

    public function times(): string
    {
        return singular_or_plural(read_count(), 'time', 'times');
    }

    public function showTimes()
    {
        if (read_count() === 0) {
            return '';
        }

        return 'Cool! Shield have protected you '.$this->times();
    }

    public function ensureExecutingMigration(): bool
    {
        $option = $this->menu($this->getTitle(), $this->getOptions())
            ->setBackgroundColour('57')
            ->setForegroundColour('white')
            ->disableDefaultItems()
            ->addLineBreak('')
            ->addLineBreak('-')
            ->addStaticItem($this->showTimes())
            ->open();

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
