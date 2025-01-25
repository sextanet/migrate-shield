<?php

it('knows the command exists', function () {
    expect(command_exists('ls'))
        ->toBeTrue();

    expect(command_exists('not-exists'))
        ->toBeFalse();
});

it('knows shield path', function () {
    expect(shield_base_path())
        ->toContain('migrate-shield');
});

it('knows shield path with custom file', function () {
    expect(shield_base_path('src/.count'))
        ->toContain('migrate-shield/src/.count');
});

describe('it knows the runs count', function () {
    afterEach(function () {
        delete_count_file();
    });

    test('when file does not exists it returns 0', function () {
        update_count(0);

        expect(read_count())
            ->toBe(0);

        expect(file_exists(get_count_file()))
            ->toBeTrue();
    });

    test('when file exists it returns number', function () {
        update_count(10);

        expect(read_count())
            ->toBe(10);

        expect(file_exists(get_count_file()))
            ->toBeTrue();
    });

    test('deletes count file', function () {
        update_count(10);

        expect(file_exists(get_count_file()))
            ->toBeTrue();

        delete_count_file();

        expect(read_count())
            ->toBe(0);

        expect(file_exists(get_count_file()))
            ->toBeFalse();
    });

    test('increments count', function () {
        delete_count_file();

        increment_count();

        expect(read_count())
            ->toBe(1);

        increment_count();

        expect(read_count())
            ->toBe(2);

        expect(file_exists(get_count_file()))
            ->toBeTrue();
    });
});

it('knows singular or plural word', function () {
    expect(singular_or_plural(1, 'item', 'items'))
        ->toBe('1 item');

    expect(singular_or_plural(2, 'item', 'items'))
        ->toBe('2 items');
});

it('knows count "time" or "times"', function () {
    delete_count_file();
    increment_count();

    expect(get_count_times())
        ->toBe('1 time');

    increment_count();

    expect(get_count_times())
        ->toBe('2 times');
});
