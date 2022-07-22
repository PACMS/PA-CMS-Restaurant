<?php

namespace App\Mail;

 use App\phpmailer\src\PHPMailer;
 use App\phpmailer\src\SMTP;
 use PHPMailer\PHPMailer\Exception;

 abstract class Mail
 {
     protected array $data = [];

     abstract public function destination(): string;
     abstract public function object (): string;
     abstract public function message(): string;

     public function __construct(array $data)
     {
         $this->data = $data;
     }

        public function mail ()
        {
            try {
                $phpmailer = new PHPMailer();
                $phpmailer->isSMTP();
                $phpmailer->Host = MHOST;
                $phpmailer->SMTPAuth = true;
                $phpmailer->Username = MUSERNAME;
                $phpmailer->Password = MPASSWORD;
                $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $phpmailer->Port = MPORT;
                $phpmailer->SMTPDebug = SMTP::DEBUG_OFF;

                $phpmailer->setFrom('pa.cms.test@gmail.com', 'PCR Contact');
                $phpmailer->addAddress($this->destination());

                $phpmailer->isHTML(true);
                $phpmailer->Subject = $this->object();
                $phpmailer->Body = $this->message();

                $phpmailer->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
            }
        }
 }