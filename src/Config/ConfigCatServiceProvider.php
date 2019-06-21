<?php

namespace Rp\Config;

use Illuminate\Support\ServiceProvider;
use ConfigCat\SDK\API\Helpers\ApiClient;
use ConfigCat\SDK\API\Helpers\InformationHeaders;

class ConfigCatServiceProvider extends ServiceProvider {
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config.php' => config_path('configcat.php'),
        ]);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        // Bind the configcat name to a singleton instance of the ConfigCat Service
        $this->app->singleton('configcat', function () {
          return new ConfigCatService();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }
}
