<?php

function command_exists($command): bool
{
    return ! empty(shell_exec(sprintf('which %s', escapeshellarg($command))));
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
    return __DIR__.'/../'.$file;
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
