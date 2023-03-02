<?php

namespace App\Services;

use App\Entities\User;

class SessionService
{
    public static function getMessage(): ?string
    {
        self::start();
        if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
            $message = $_SESSION['message'];
            unset($_SESSION['message']);

            return $message;
        }

        return null;
    }

    public static function setMessage(string $message): void
    {
        self::start();
        if ('' !== $message) $_SESSION['message'] = $message;
    }

    private static function start()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    private static function stop()
    {
        self::start();

        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }

        session_destroy();
    }
}