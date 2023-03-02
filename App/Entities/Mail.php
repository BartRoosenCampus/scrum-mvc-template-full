<?php

namespace App\Entities;

use App\Services\MailService;

class Mail
{
    const MESSAGE            = 'mail';
    const EMAIL_VERIFICATION = 'verify-email';

    private string  $recipient;
    private string  $recipientName;
    private string  $message;
    private string  $subject;
    private string $mailType;

    private function __construct(
        string  $recipient,
        string  $recipientName,
        string  $subject,
        string  $message,
        string $mailType
    )
    {
        $this->recipient     = $recipient;
        $this->recipientName = $recipientName;
        $this->message       = $message;
        $this->subject       = $subject;
        $this->mailType      = $mailType;
    }

    public static function create(
        string  $recipient,
        string  $recipientName,
        string  $subject,
        string  $message,
        ?string $mailType = self::MESSAGE
    )
    {
        return new Mail($recipient, $recipientName, $subject, $message, $mailType);
    }

    public function getRecipient(): string
    {
        return $this->recipient;
    }

    public function getRecipientName(): string
    {
        return $this->recipientName;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getMailType(): ?string
    {
        return $this->mailType;
    }

    public function send()
    {
        $mailService = new MailService();
        $mailService->send($this);
    }
}
