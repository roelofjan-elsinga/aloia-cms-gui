<?php

namespace FlatFileCms\GUI;

use FlatFileCms\GUI\Middleware\Authenticated;
use FlatFileCms\GUI\Middleware\Guest;
use FlatFileCms\GUI\Translations\Translator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class FlatFileCmsServiceProvider extends ServiceProvider
{

    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'FlatFileCms\GUI\Controllers';

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/flatfilecmsgui.php', 'flatfilecmsgui'
        );

        require "helpers.php";

        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\AssetsCommand::class,
                Console\ConfigCommand::class,
                Console\ViewsCommand::class,
                Console\AppSecretGenerator::class,
                Console\CreateAccount::class,
            ]);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/flatfilecmsgui.php' => config_path('flatfilecmsgui.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/flatfilecmsgui'),
        ], 'public');

        $this->loadViewsFrom(__DIR__.'/../views', 'flatfilecmsgui');

        $this->publishes([
            __DIR__.'/../views/templates' => resource_path('views/vendor/flatfilecmsgui/templates'),
        ], 'views');

        $this->registerRoutes();
    }

    /**
     * Register the Horizon routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        $this->app['router']->aliasMiddleware('fileAuth', Authenticated::class);
        $this->app['router']->aliasMiddleware('fileGuest', Guest::class);

        Route::group([
            'domain' => config('flatfilecmsgui.domain', null),
            'prefix' => config('flatfilecmsgui.path'),
            'namespace' => $this->namespace,
            'middleware' => config('flatfilecmsgui.middleware', 'web'),
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

}
