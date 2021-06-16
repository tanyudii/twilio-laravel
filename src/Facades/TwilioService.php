<?php

namespace Tanyudii\TwilioLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void sendSms(string $to, string $message)
 * @method static void sendWa(string $to, string $message)
 *
 * @see \Tanyudii\TwilioLaravel\Services\AfterShipService
 */
class TwilioService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'twilio-laravel';
    }
}
