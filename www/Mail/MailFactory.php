<?php

namespace App\Mail;

use Exception;

class MailFactory
{
    /**
     * @throws Exception
     */
    public static function createMail (string $mail, array $data): Mail
    {
        $className = "App\\Mail\\" . ucfirst($mail) . "Mail";

        if (!class_exists($className)) throw new Exception("Mail class not found");

        return new $className($data);
    }
}