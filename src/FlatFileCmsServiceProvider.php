<?php

namespace FlatFileCms\GUI;

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
        ]);

        $this->loadViewsFrom(__DIR__.'/../views', 'flatfilecmsgui');

        $this->registerRoutes();
    }

    /**
     * Register the Horizon routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
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