<?php

function command_exists($command): bool
{
    return ! empty(shell_exec(sprintf('which %s', escapeshellarg($command))));
}

function shield_base_path(?string $file = ''): string
{
    return app('shield-base-path').($file ? '/'.$file : '');
}

function delete_count_file(): void
{
    $file = get_count_file();

    if (file_exists($file)) {
        unlink($file);
    }
}

function get_count_file($file = '.count'): string
{
    return shield_base_path($file);
}

function update_count(int $count): void
{
    file_put_contents(get_count_file(), $count);
}

function read_count(): int
{
    $file = get_count_file();

    if (! file_exists($file)) {
        return 0;
    }

    return (int) file_get_contents($file);
}

function increment_count(int $by = 1): void
{
    $count = read_count();

    update_count($count + $by);
}

function singular_or_plural(int $count, string $singular, string $plural): string
{
    $result = "{$count} ";
    $result .= $count === 1 ? $singular : $plural;

    return $result;
}

function get_count_times(): string
{
    return singular_or_plural(read_count(), 'time', 'times');
}
