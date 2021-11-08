<?php

namespace App\Services;

use SendGrid;
use SendGrid\Mail\Mail;

class ContactService
{
    private $sendGrid;
    private $mail;

    public function __construct(SendGrid $sendGrid, Mail $mail)
    {
        $this->sendGrid = $sendGrid;
        $this->mail = $mail;
    }

    public function sendEmail($from_email, $from_name, $to_email, $to_name, $subject, $message)
    {
        $this->mail->setFrom($from_email, $from_name);
        $this->mail->setSubject($subject);
        $this->mail->addTo($to_email, $to_name);
        $this->mail->addContent("text/plain", $message);

        $response = $this->sendGrid->send($this->mail);

//        print $response->statusCode() . "\n";
//        Code - Meaning
//        --------------
//        401 - Error
//        202 - Success
//        print_r($response->headers());
//        print $response->body() . "\n";
        return $response->statusCode();
    }

    public function buildMessageContactUs($user_name, $user_email, $subject, $user_message)
    {
        return "От: " . $user_name . PHP_EOL . 'Имейл: ' . $user_email . PHP_EOL . "Тема: " . $subject . PHP_EOL . "Съобщение: " . $user_message;
    }
}
