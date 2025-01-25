# Migrate Shield

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sextanet/migrate-shield.svg?style=flat-square)](https://packagist.org/packages/sextanet/migrate-shield)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/sextanet/migrate-shield/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/sextanet/migrate-shield/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/sextanet/migrate-shield/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/sextanet/migrate-shield/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/sextanet/migrate-shield.svg?style=flat-square)](https://packagist.org/packages/sextanet/migrate-shield)

Protects your production environment by backing up your current database automatically with Spatie's Laravel Backup.

## Installation

You can install the package via composer:

```bash
composer require sextanet/migrate-shield
```

## Usage

Simply, use your traditional commands in production mode

```bash
php artisan migrate:fresh
php artisan migrate:fresh --db-seed
```

You will get covered and intercepted with Shield

## Configuration

By default, it works inmediately with zero config. But also, you can customize some things

```dotenv
MIGRATE_SHIELD_DISK=local
MIGRATE_SHIELD_PASSWORD="YOURPASSWORD"
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="migrate-shield-config"
```

## Troubleshooting

If have your `mysqldump` or `pg_dump` in another location, you need to add dump

Source: https://spatie.be/docs/laravel-backup/v8/installation-and-setup

```php
//config/database.php

'connections' => [
	'mysql' => [
		'driver' => 'mysql'
		...,
		'dump' => [
            'dump_binary_path' => env('MYSQL_DUMP_BINARY_PATH', null), // only the path, so without `mysqldump` or `pg_dump`
            'timeout' => env('MYSQL_DUMP_TIMEOUT', 60 * 5), // 5 minutes timuout
        ],
    ]
],
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [SextaNet](https://github.com/SextaNet)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
