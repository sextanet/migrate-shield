<?php

it('knows the command exists', function () {
    expect(command_exists('ls'))
        ->toBeTrue();

    expect(command_exists('not-exists'))
        ->toBeFalse();
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
