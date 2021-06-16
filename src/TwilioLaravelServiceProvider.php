<?php

namespace Tanyudii\TwilioLaravel;

use Illuminate\Support\ServiceProvider;
use Tanyudii\TwilioLaravel\Services\TwilioService;

class TwilioLaravelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->alias('twilio-laravel', TwilioService::class);
        $this->app->singleton('twilio-laravel', function () {
            return new TwilioService;
        });

        $this->registerPublishing();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    private function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            // Lumen lacks a config_path() helper, so we use base_path()
            $this->publishes([
                __DIR__.'/../config/twilio-laravel.php' => base_path('config/twilio-laravel.php'),
            ], 'laravel-twilio-config');
        }
    }
}
