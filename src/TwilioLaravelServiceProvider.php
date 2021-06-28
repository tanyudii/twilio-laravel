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
        $this->mergeConfigFrom(__DIR__ . "/../config/twilio-laravel.php", "twilio-laravel");

        $this->app->bind("twilio-service", function () {
            return new TwilioService;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    __DIR__ . "/../config/twilio-laravel.php" => config_path(
                        "twilio-laravel.php"
                    ),
                ],
                "twilio-laravel-config"
            );
        }
    }
}
