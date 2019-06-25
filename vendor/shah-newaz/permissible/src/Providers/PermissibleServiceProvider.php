<?php

namespace Shahnewaz\Permissible\Providers;

use Illuminate\Support\ServiceProvider;
use Shahnewaz\Permissible\Console\Commands\Setup;
use Shahnewaz\Permissible\Services\PermissibleService;
use Shahnewaz\Permissible\Console\Commands\RolePermissionSeed;


class PermissibleServiceProvider extends ServiceProvider
{
    /** 
    * This provider cannot be deferred since it loads routes.
    * If deferred, run `php artisan route:cache`
    **/
    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot () {

        if ($this->app->runningInConsole()) {
            $this->commands([
                RolePermissionSeed::class
            ]);
        }
        if ($this->app->runningInConsole()) {
            $this->commands([
                Setup::class
            ]);
        }

        $this->load();
        $this->publish();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register () {
        $this->mergeConfigFrom($this->packagePath('config/permissible.php'), 'permissible');
        // Add route middlewares
        $this->app['router']->aliasMiddleware(
            'role', \Shahnewaz\Permissible\Http\Middleware\RoleAccessGuard::class
        );
        $this->app['router']->aliasMiddleware(
            'permission', \Shahnewaz\Permissible\Http\Middleware\PermissionAccessGuard::class
        );

        // Register Permissible Service
        $this->app->singleton('permissible', function ($app) {
            return new PermissibleService;
        });
    }

    // Root path for package files
    private function packagePath ($path) {
        return __DIR__."/../../$path";
    }

    // Facade provider
    public function provides () {
        return ['permissible'];
    }

    // Class loaders for package
    public function load () {
        // Routes
        $this->loadRoutesFrom($this->packagePath('src/routes/web.php'));
        // Migrations
        $this->loadMigrationsFrom($this->packagePath('database/migrations'));
        // Translations
        $this->loadTranslationsFrom($this->packagePath('resources/lang'), 'permissible');
         // Views
        $this->loadViewsFrom($this->packagePath('resources/views'), 'permissible');
    }

    // Publish required resouces from package
    private function publish () {
        // Publish Translations
        $this->publishes([
            $this->packagePath('resources/lang') => resource_path('lang/vendor/permissible'),
        ], 'permissible-translations');
        
        // Publish Permissible Config
        $this->publishes([
            $this->packagePath('config/permissible.php') => config_path('permissible.php'),
        ], 'permissible-config');

        $this->publishes([
            $this->packagePath('config/jwt.php') => config_path('jwt.php'),
        ], 'permissible-jwt-config');

        $this->publishes([
            $this->packagePath('config/auth.php') => config_path('auth.php'),
        ], 'permissible-auth-config');

        $this->publishes([
            $this->packagePath('config/jwt.php') => config_path('jwt.php'),
        ], 'config');

        $this->publishes([
            $this->packagePath('config/auth.php') => config_path('auth.php'),
        ], 'config');

        // Publish views
        $this->publishes([
            $this->packagePath('resources/views') => resource_path('views/vendor'),
        ], 'permissible-views');
    }
}
