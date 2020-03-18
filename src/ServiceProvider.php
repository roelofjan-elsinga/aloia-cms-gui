<?php

namespace AloiaCms\GUI;

use Collective\Html\HtmlServiceProvider;
use AloiaCms\GUI\Middleware\Authenticated;
use AloiaCms\GUI\Middleware\Guest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{

    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'AloiaCms\GUI\Controllers';

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(HtmlServiceProvider::class);

        $this->mergeConfigFrom(
            __DIR__.'/../config/aloiacmsgui.php',
            'aloiacmsgui'
        );

        require "helpers.php";

        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\AssetsCommand::class,
                Console\ConfigCommand::class,
                Console\ViewsCommand::class,
                Console\AppSecretGenerator::class,
                Console\CreateAccount::class,
                Console\SelfUpgradeCommand::class,
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
            __DIR__.'/../config/aloiacmsgui.php' => config_path('aloiacmsgui.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/aloiacmsgui'),
        ], 'public');

        $this->loadViewsFrom(__DIR__.'/../views', 'aloiacmsgui');

        $this->publishes([
            __DIR__.'/../views/templates' => resource_path('views/vendor/aloiacmsgui/templates'),
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
            'domain' => config('aloiacmsgui.domain', null),
            'prefix' => config('aloiacmsgui.path'),
            'namespace' => $this->namespace,
            'middleware' => config('aloiacmsgui.middleware', 'web'),
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }
}
