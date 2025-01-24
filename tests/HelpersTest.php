<?php

it('knows the command exists', function () {
    expect(command_exists('ls'))
        ->toBeTrue();

    expect(command_exists('not-exists'))
        ->toBeFalse();
});
