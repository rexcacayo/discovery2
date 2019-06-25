## Laravel 5.4 Config Writer

Write to Laravel Config files and maintain file integrity.

This library is an extension of the Config component used by Laravel 5.4. It adds the ability to write to configuration files.

You can rewrite array values inside a basic configuration file that returns a single array definition (like a Laravel config file) whilst maintaining the file integrity, leaving comments and advanced settings intact.

The following value types are supported for writing: strings, integers, booleans and single-dimension arrays.

Fork of `octobercms\laravel-config-writer`.

### Usage Instructions

Install through composer:
```php
composer require "sergeymiracle/config-writer"
```

Add this to `app/config/app.php` under the 'providers' key:

```php
SergeyMiracle\Config\ConfigServiceProvider::class,
```

You can now write to config files:

```php
Config::write(['app.url' => 'http://domain.com']);

app('config')->write(['app.url' => 'http://domain.com']);
```

### Usage outside Laravel

The `Rewrite` class can be used anywhere.

```php
$writeConfig = new SergeyMiracle\Config\Rewrite;
$writeConfig->toFile('path/to/config.php', [
    'item' => 'new value',
    'nested.config.item' => 'value',
    'arrayItem' => ['Single', 'Level', 'Array', 'Values'],
    'numberItem' => 3,
    'booleanItem' => true
]);
```
