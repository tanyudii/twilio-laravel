<?php

namespace Tanyudii\TwilioLaravel\Services;

use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class TwilioService
{
    /**
     * Twilio client service
     *
     * @var Client
     */
    protected $client;

    /**
     * Twilio from message
     *
     * @var string
     */
    protected $from;

    /**
     * Twilio whatsapp from
     *
     * @var string
     */
    protected $whatsAppFrom;

    /**
     * TwilioService constructor.
     *
     * @throws ConfigurationException
     */
    public function __construct()
    {
        try {
            $this->client = new Client(
                config('twilio-laravel.sid'),
                config('twilio-laravel.token')
            );

            $this->from = config('twilio-laravel.from');
            $this->whatsAppFrom = config('twilio-laravel.whatsapp_from');
        } catch (ConfigurationException $e) {
            throw $e;
        }
    }

    /**
     * Send message from twilio
     *
     * @param string $to
     * @param string $message
     * @throws TwilioException
     */
    public function sendSms(string $to, string $message) {
        try {
            $this->client->messages->create($to, [
                'from' => $this->from,
                'body' => $message,
            ]);
        } catch (TwilioException $e) {
            throw $e;
        }
    }

    /**
     * Send whatsapp from twilio
     *
     * @param string $to
     * @param string $message
     * @throws TwilioException
     */
    public function sendWa(string $to, string $message) {
        try {
            $this->client->messages->create('whatsapp:' . $to, [
                'from' => 'whatsapp:' . $this->whatsAppFrom,
                'body' => $message,
            ]);
        } catch (TwilioException $e) {
            throw $e;
        }
    }
}
