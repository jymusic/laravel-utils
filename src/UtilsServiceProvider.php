<?php

namespace JYmusic\Utils;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use JYmusic\Utils\JavaScript\Transformer;

class UtilsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('utils', function() {
            return  new Util();
        });

        $this->mergeConfigFrom(
            __DIR__ . '/config/utils.php',
            'utils'
        );
    }

    /**
     * Publish the plugin configuration.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/utils.php' => config_path('uitls.php')
        ]);
    }
}
