<?php

use Illuminate\Support\Facades\Http;
use SextaNet\MigrateShield\MigrateShield;

beforeEach(function () {
    delete_count_file();

    Http::fake();
});

it('can share count to original url', function () {
    MigrateShield::shareCount();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://sextanet.com/api/packages/migrate-shield/share';
    });

    Http::assertSent(function ($request) {
        return $request['count'] === 0;
    });

    Http::assertSent(function ($request) {
        return $request['php_version'] === phpversion();
    });

    Http::assertSent(function ($request) {
        return $request['laravel_version'] === app()->version();
    });

    Http::assertSent(function ($request) {
        return collect($request->header('User-Agent'))->contains('Migrate Shield');
    });
});

it('can share count to custom url', function () {
    config()->set('migrate-shield.share_url', 'https://sexta.net.dev/api/packages/migrate-shield/share');

    MigrateShield::shareCount();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://sexta.net.dev/api/packages/migrate-shield/share';
    });

    Http::assertSent(function ($request) {
        return $request['count'] === 0;
    });

    Http::assertSent(function ($request) {
        return $request['php_version'] === phpversion();
    });

    Http::assertSent(function ($request) {
        return $request['laravel_version'] === app()->version();
    });

    Http::assertSent(function ($request) {
        return collect($request->header('User-Agent'))->contains('Migrate Shield');
    });
});
