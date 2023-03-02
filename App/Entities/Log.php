<?php

namespace App\Entities;

use App\Services\LogService;
use JetBrains\PhpStorm\Pure;

class Log
{
    const ERROR   = 'error';
    const WARNING = 'warning';
    const INFO    = 'info';

    private string $message;
    private string $type;

    private function __construct(string $message, string $type)
    {
        $this->message = $message;
        $this->type    = $type;
    }

    #[Pure] public static function create(string $message, string $type = self::INFO): Log
    {
        return new Log($message, $type);
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function add(): void
    {
        LogService::add($this);
    }
}
