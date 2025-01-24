<?php

function command_exists($command): bool
{
    return ! empty(shell_exec(sprintf('which %s', escapeshellarg($command))));
}
