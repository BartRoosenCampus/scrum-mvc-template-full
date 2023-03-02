<?php

namespace App\Services;

use App\Entities\Mail;
use JetBrains\PhpStorm\Pure;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailService
{
    private array     $mailServer;
    private PHPMailer $mailer;

    #[Pure] public function __construct()
    {
        $this->mailer     = new PHPMailer();
        $this->mailServer = YamlService::parseFile('mailer');
    }


    public function send(Mail $mail)
    {
        $mailContent = file_get_contents(sprintf('templates/mail/%s.html', $mail->getMailType()));

        /** Mail */
        try {
            //Server settings
            $this->mailer->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $this->mailer->isSMTP();                                            //Send using SMTP
            $this->mailer->Host       = $this->mailServer['host'];
            $this->mailer->SMTPAuth   = true;                                   //Enable SMTP authentication
            $this->mailer->Username   = $this->mailServer['userName'];
            $this->mailer->Password   = $this->mailServer['pass'];
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $this->mailer->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $this->mailer->setFrom($this->mailServer['from'], $this->mailServer['fromName']);
            $this->mailer->addAddress($mail->getRecipient(), $mail->getRecipientName());
//    $this->mail->addAddress('ellen@example.com');               //Name is optional
//    $this->mail->addReplyTo('info@example.com', 'Information');
//    $this->mail->addCC('cc@example.com');
//    $this->mail->addBCC('bcc@example.com');

            //Attachments
//    $this->mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
//    $this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $this->mailer->isHTML(true);                                  //Set email format to HTML
            $this->mailer->Subject = $mail->getSubject();
            $this->mailer->Body    = sprintf($mailContent, $mail->getSubject(), $mail->getRecipientName(), $mail->getMessage());
            $this->mailer->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $this->mailer->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mailer->ErrorInfo}";
        }
    }
}