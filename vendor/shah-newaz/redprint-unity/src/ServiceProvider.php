<?php

namespace Shahnewaz\RedprintUnity;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Container\Container;
use Shahnewaz\RedprintUnity\Events\BuildingMenu;
use Shahnewaz\RedprintUnity\Console\RedprintUnityMakeCommand;
use Shahnewaz\RedprintUnity\Console\MakeRedprintUnityCommand;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Shahnewaz\RedprintUnity\Http\ViewComposers\RedprintUnityComposer;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->app->singleton(RedprintUnity::class, function (Container $app) {
            return new RedprintUnity(
                $app['config']['redprintUnity.filters'],
                $app['events'],
                $app
            );
        });
    }

    public function boot(
        Factory $view,
        Dispatcher $events,
        Repository $config
    ) {
        $this->loadViews();
        $this->loadTranslations();
        $this->publishConfig();
        $this->publishAssets();
        $this->registerCommands();
        $this->registerViewComposers($view);
        static::registerMenu($events, $config);
    }

    private function loadViews()
    {
        $viewsPath = $this->packagePath('resources/views');

        $this->loadViewsFrom($viewsPath, 'redprintUnity');

        $this->publishes([
            $viewsPath => base_path('resources/views/vendor/redprintUnity'),
        ], 'views');
    }

    private function loadTranslations()
    {
        $translationsPath = $this->packagePath('resources/lang');
        $this->loadTranslationsFrom($translationsPath, 'redprintUnity');
        $this->publishes([
            $translationsPath => base_path('resources/lang/vendor/redprintUnity'),
        ], 'translations');
    }

    private function publishConfig()
    {
        $configPath = $this->packagePath('config/redprintUnity.php');
        $this->publishes([
            $configPath => config_path('redprintUnity.php'),
        ], 'redprint-unity-config');
        $this->mergeConfigFrom($configPath, 'redprintUnity');
    }

    private function publishAssets()
    {
        $this->publishes([
            $this->packagePath('resources/assets') => public_path('vendor/redprintUnity'),
        ], 'redprint-unity-assets');

        $this->publishes([
            $this->packagePath('resources/lang') => resource_path('lang/vendor/redprintUnity'),
        ], 'redprintUnity-translations');
        
    }

    private function packagePath($path)
    {
        return __DIR__."/../$path";
    }

    private function registerCommands()
    {
        // Laravel >=5.2 only
        if (class_exists('Illuminate\\Auth\\Console\\MakeAuthCommand')) {
            $this->commands(MakeRedprintUnityCommand::class);
        } elseif (class_exists('Illuminate\\Auth\\Console\\AuthMakeCommand')) {
            $this->commands(RedprintUnityMakeCommand::class);
        }
    }

    private function registerViewComposers(Factory $view)
    {
        $view->composer('redprintUnity::page', RedprintUnityComposer::class);
    }

    public static function registerMenu(Dispatcher $events, Repository $config)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) use ($config) {
            $menu = $config->get('redprintUnity.menu');
            call_user_func_array([$event->menu, 'add'], $menu);
        });
    }
}
