<?php

namespace App\Controller;

use App\Core\View;
use App\phpmailer\src\PHPMailer;
use App\phpmailer\src\SMTP;
use App\phpmailer\src\Exception;
use App\Model\User;
class Mail
{
    public function index()
    {
        $view = new View("testmail");
    }

    public function sendConfirmMail($user)
    {

        try {
            $actualDateTime = new \DateTime();
            $actualDateTime = $actualDateTime->format('YmdHis');
            $message = "http://localhost/verifyToken?token=" . $user->getToken() . '&email=' . $user->getEmail() . '&date=' . $actualDateTime;
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
            $phpmailer->addAddress($user->getEmail());     //Add a recipient


            //Content
            $phpmailer->isHTML(true);                                  //Set email format to HTML
            $phpmailer->Subject = 'Valider votre inscription !';
            // $phpmailer->Body    = "This is the HTML message body <b>in bold!</b>
            //                        <a href={$message}>Lien de confirmation</a>
            //                        <b>Ce mail n'est valable que 10 minutes</b>";
            $phpmailer->Body    = "Bonjour {$user->getLastname()} {$user->getFirstname()}, <br>
                                Pour valider votre inscription à notre site veuillez vous connectez avec ce lien:  <br> 
                                <a href={$message}>Lien de confirmation</a><br>
                                Merci pour votre inscription ! <br>
                                L'équipe PACM";

            $phpmailer->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
        }
    }

    public function lostPasswordMail(?string $token, ?string $email)
    {
        try {
            $actualDateTime = new \DateTime();
            $actualDateTime = $actualDateTime->format('YmdHis');
            $message = "http://localhost/resetPassword?token=" . $token . '&email=' . $email . '&date=' . $actualDateTime;
            $phpmailer = new PHPMailer();
            //Server settings
            $phpmailer->isSMTP();
            $phpmailer->SMTPDebug = SMTP::DEBUG_CONNECTION;
            $phpmailer->Host = MHOST;
            $phpmailer->SMTPAuth = true;
            $phpmailer->Username = MUSERNAME;
            $phpmailer->Password = MPASSWORD;
            $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $phpmailer->Port = MPORT;

            //Recipients
            $phpmailer->setFrom('pa.cms.test@gmail.com', 'PCR Contact');
            $phpmailer->addAddress($email);     //Add a recipient
            // $phpmailer->addAddress('vivin.fr@free.fr');     //Add a recipient


            //Content
            $phpmailer->isHTML(true);                                  //Set email format to HTML
            $phpmailer->Subject = 'Salut Vivian Ruhlmann';
            $phpmailer->Body    = "This is the HTML message body <b>in bold!</b>
                                   <a href={$message}>Réinitialiser votre mot de passe</a>
                                   <b>Ce mail n'est valable que 10 minutes</b>";

            $phpmailer->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
        }
    }

    public function askCommentMail(string $email, string $name, int $id_restaurant)
    {
        try {
            $actualDateTime = new \DateTime();
            $actualDateTime = $actualDateTime->format('YmdHis');
            $message = "http://localhost/addComment?restaurant={$id_restaurant}";
            $phpmailer = new PHPMailer();
            //Server settings
            $phpmailer->isSMTP();
            $phpmailer->SMTPDebug = SMTP::DEBUG_CONNECTION;
            $phpmailer->Host = MHOST;
            $phpmailer->SMTPAuth = true;
            $phpmailer->Username = MUSERNAME;
            $phpmailer->Password = MPASSWORD;
            $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $phpmailer->Port = MPORT;

            //Recipients
            $phpmailer->setFrom('pa.cms.test@gmail.com', 'PCR Contact');
            $phpmailer->addAddress($email);     //Add a recipient
            // $phpmailer->addAddress('vivin.fr@free.fr');     //Add a recipient


            //Content
            $phpmailer->isHTML(true);                                  //Set email format to HTML
            $phpmailer->Subject = "Laissez un commentaire sur le site";
            $phpmailer->Body    = "Salut {$name}, {$message}";
            $phpmailer->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
        }
    }

    public function askValidationComment(User $user)
    {
        try {
            $actualDateTime = new \DateTime();
            $actualDateTime = $actualDateTime->format('YmdHis');
            $message = "http://localhost/addComment?restaurant={$id_restaurant}";
            $phpmailer = new PHPMailer();
            //Server settings
            $phpmailer->isSMTP();
            $phpmailer->SMTPDebug = SMTP::DEBUG_CONNECTION;
            $phpmailer->Host = MHOST;
            $phpmailer->SMTPAuth = true;
            $phpmailer->Username = MUSERNAME;
            $phpmailer->Password = MPASSWORD;
            $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $phpmailer->Port = MPORT;

            //Recipients
            $phpmailer->setFrom('pa.cms.test@gmail.com', 'PCR Contact');
            $phpmailer->addAddress($user->getEmail());     //Add a recipient
            // $phpmailer->addAddress('vivin.fr@free.fr');     //Add a recipient


            //Content
            $phpmailer->isHTML(true);                                  //Set email format to HTML
            $phpmailer->Subject = "Vous avez un nouveau commentaire en attente";
            $phpmailer->Body    = "Bonjour {$user->getFirstName()} {$user->getLastName()}, Vous avez un nouveau commentaire à valider !!";
            $phpmailer->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
        }
    }
}
