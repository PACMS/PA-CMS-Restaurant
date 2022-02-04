<?php

namespace App\Controller;

use App\Core\View;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail
{

    public function index(){
        $view = new View("testmail");
    }

    public function sendConfirmMail(){

        try {

        $phpmailer = new PHPMailer();
        //Server settings
        $phpmailer->isSMTP();
        $phpmailer->Host = MHOST;
        $phpmailer->SMTPAuth = true;
        $phpmailer->Username = MUSERNAME;
        $phpmailer->Password = MPASSWORD;
        $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $phpmailer->Port = MPORT;

        //Recipients
        $phpmailer->setFrom('pa.cms.test@gmail.com', 'PCR Contact');
        $phpmailer->addAddress('vivian.fr@free.fr');     //Add a recipient


        //Content
        $phpmailer->isHTML(true);                                  //Set email format to HTML
        $phpmailer->Subject = 'Salut Vivan rulleman';
        $phpmailer->Body    = 'This is the HTML message body <b>in bold!</b>
<button>Lien de confirmation</button>';
        $phpmailer->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
        }
    }
   /* public function templateConfirmMail{


        return
    }*/
}