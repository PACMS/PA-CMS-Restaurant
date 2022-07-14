<?php

namespace App\Controller;

use App\Core\View;
use App\phpmailer\src\PHPMailer;
use App\phpmailer\src\SMTP;
use App\phpmailer\src\Exception;
use App\Model\User;
use App\Core\MysqlBuilder;
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
            $message = $_SERVER["REQUEST_SCHEME"] . "://" . APP_URL . "/" . "verifyToken?token=" . $user->getToken() . '&email=' . $user->getEmail() . '&date=' . $actualDateTime;
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

    public function lostPasswordMail(User $user, string $token)
    {
        try {
            $message = $_SERVER["REQUEST_SCHEME"] . "://" . APP_URL . "/" . "resetPassword?token=" . $token;
            $phpmailer = new PHPMailer();
            //Server settings
            $phpmailer->isSMTP();
            $phpmailer->SMTPDebug = SMTP::DEBUG_OFF;
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
            $phpmailer->Subject = 'Mot de passe oublié';
            $phpmailer->Body    = "Mot de passe oublié ? Cliquez sur ce lien : 
                                   <a href={$message}>Réinitialiser votre mot de passe / connexion magique</a> <br>
                                   <b>Ce mail n'est valable qu'une heure !</b>";

            $phpmailer->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
        }
    }

    public function activePasswordMail(User $user, string $token)
    {
        try {
            $message = "http://localhost/resetPassword?token=" . $token;
            $phpmailer = new PHPMailer();
            //Server settings
            $phpmailer->isSMTP();
            $phpmailer->SMTPDebug = SMTP::DEBUG_OFF;
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
            $phpmailer->Subject = 'Activer votre compte';
            $phpmailer->Body    = "Pour activer votre compte et choisir un mot de passe, merci de cliquer sur : 
                                   <a href={$message}>Choisir un mot de passe</a> <br>
                                   <b>Ce mail n'est valable qu'une heure !</b>";

            $phpmailer->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
        }
    }

    public function sendConfirmUpdateUserMail(User $user)
    {
        try {
            $phpmailer = new PHPMailer();
            //Server settings
            $phpmailer->isSMTP();
            $phpmailer->SMTPDebug = SMTP::DEBUG_OFF;
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
            $phpmailer->Subject = 'Modification du compte par un administrateur';
            $phpmailer->Body    = "
                                    Un administrateur a modifié votre compte avec les informations suivantes : <br>
                                    Nom : {$user->getLastname()} <br>
                                    Prénom : {$user->getFirstname()} <br>
                                    Email : {$user->getEmail()} <br>
                                    Role : {$user->getRole()} <br>
                                   ";

            $phpmailer->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
        }
    }

    public function askCommentMail(string $email, string $name, int $id_restaurant)
    {
        try {
            $builder = new MysqlBuilder();
            $pages = $builder->select("page", ["*"])
                            ->where("id_restaurant", $id_restaurant)
                            ->fetchClass("page")
                            ->fetchAll();
            foreach ($pages as $page) {
                if (str_contains($page->getTitle(), "index") ) {
                    $message = $_SERVER["REQUEST_SCHEME"] . "://" . APP_URL . "/" . $page->getUrl();
                }
            }
            $actualDateTime = new \DateTime();
            $actualDateTime = $actualDateTime->format('YmdHis');
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

            header("Location: /restaurant/reservation");
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
        }
    }

    public function askValidationComment(User $user)
    {
        try {
            $actualDateTime = new \DateTime();
            $actualDateTime = $actualDateTime->format('YmdHis');
            $message = $_SERVER["REQUEST_SCHEME"] . "://" . APP_URL . "/" . "restaurant/comments";
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
            $phpmailer->Body    = "Bonjour {$user->getFirstName()} {$user->getLastName()}, Vous avez un nouveau commentaire à valider !! {$message}";
            $phpmailer->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
        }
    }

    public function tempMailReservation(string $name, string $date, string $hour, string $nbPerson, string $email)
    {
        try {
            $actualDateTime = new \DateTime();
            $actualDateTime = $actualDateTime->format('YmdHis');
            $message = "Votre réservation est en attente de confirmation par le restaurant. Dès que cela sera validé, vous recevrez une validation par mail, pensez à regarder vos spams ! <br>";
            $message .= "Récapitulatif de votre réservation : Au nom de : {$name}";
            $message .= "Pour le : {$date}";
            $message .= "A : {$hour}";
            $message .= "Pour : {$nbPerson} personne(s)";
            $phpmailer = new PHPMailer();
            //Server settings
            $phpmailer->isSMTP();
            $phpmailer->SMTPDebug = SMTP::DEBUG_OFF;
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
            $phpmailer->Subject = "Réservation en attente";
            $phpmailer->Body    = "Salut {$name}, {$message}";
            $phpmailer->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
        }
    }

    public function confirmMailReservation(string $name, string $date, string $hour, string $nbPerson, string $email)
    {
        try {
            $actualDateTime = new \DateTime();
            $actualDateTime = $actualDateTime->format('YmdHis');
            $message = "Votre réservation a été confirmée par le restaurateur, voici le détail : <br>";
            $message .= "Récapitulatif de votre réservation : Au nom de : {$name}";
            $message .= "Pour le : {$date}";
            $message .= "A : {$hour}";
            $message .= "Pour : {$nbPerson} personne(s)";
            $phpmailer = new PHPMailer();
            //Server settings
            $phpmailer->isSMTP();
            $phpmailer->SMTPDebug = SMTP::DEBUG_OFF;
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
            $phpmailer->Subject = "Réservation confirmée";
            $phpmailer->Body    = "Salut {$name}, {$message}";
            $phpmailer->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
        }
    }
}
