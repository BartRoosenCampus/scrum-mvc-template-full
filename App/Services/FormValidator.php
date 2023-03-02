<?php

namespace App\Services;

use JetBrains\PhpStorm\Pure;

class FormValidator
{
    const EMAIL  = 'email';
    const TEXT   = 'text';
    const PASS   = 'pass';
    const NUMBER = 'number';

    #[Pure] public static function validateForm(array $post, array $keys): ?array
    {
        if (empty($keys)) return null;

        foreach ($keys as $key => $value) {
            if (!array_key_exists($key, $post)) return null;
            if (empty($post[$key])) return null;
        }

        $sanitizedPost = self::sanitize($post);

        foreach ($keys as $key => $type) {
            switch ($type) {
                case self::EMAIL:
                    if (!filter_var($sanitizedPost[$key], FILTER_VALIDATE_EMAIL)) return null;
                    break;
                case self::TEXT:
                case self::PASS:
                    if (!is_string($sanitizedPost[$key])) return null;
                    break;
                case self::NUMBER:
                    if (!is_numeric($sanitizedPost[$key])) return null;
                    break;
                default:
                    break;
            }
        }

        return $sanitizedPost;
    }

    private static function sanitize(array $post): array
    {
        foreach ($post as $key => $value) {
            $post[$key]  = stripslashes(htmlspecialchars(trim($value)));
        }

        return $post;
    }
}