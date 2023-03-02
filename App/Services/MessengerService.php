<?php

namespace App\Services;

class MessengerService
{
    public static function add(string $message)
    {
        SessionService::setMessage($message);
    }

    public static function get(): ?string
    {
        return SessionService::getMessage();
    }
}