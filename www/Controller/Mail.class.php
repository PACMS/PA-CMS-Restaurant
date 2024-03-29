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

    public function sendConfirmUpdateUserMail(User $user)
    {
        try {
            $phpmailer = new PHPMailer();
            //Server settings
            $phpmailer->isSMTP();
            $this->serverSettings($phpmailer, $user);                                  //Set email format to HTML
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
            $phpmailer->Subject = "Laissez un commentaire sur le site";
            $phpmailer->Body    = "Salut {$name}, {$message}";
            $phpmailer->send();

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
            $this->serverSettings($phpmailer, $user);                                  //Set email format to HTML
            $phpmailer->Subject = "Vous avez un nouveau commentaire en attente";
            $phpmailer->Body    = "Bonjour {$user->getFirstName()} {$user->getLastName()}, Vous avez un nouveau commentaire à valider !! {$message}";
            $phpmailer->send();
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
            $message .= "Récapitulatif de votre réservation : <br> Au nom de : {$name} <br>";
            $message .= "Pour le : {$date} <br>";
            $message .= "A : {$hour} <br>";
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
            $message .= "Récapitulatif de votre réservation : <br> Au nom de : {$name}  <br>";
            $message .= "Pour le : {$date}  <br>";
            $message .= "A : {$hour}  <br>";
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

    /**
     * @param PHPMailer $phpmailer
     * @param $user
     * @return void
     */
    private function serverSettings(PHPMailer $phpmailer, $user): void
    {
        $phpmailer->Host = MHOST;
        $phpmailer->SMTPAuth = true;
        $phpmailer->Username = MUSERNAME;
        $phpmailer->Password = MPASSWORD;
        $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $phpmailer->Port = MPORT;
        $phpmailer->SMTPDebug = SMTP::DEBUG_OFF;

        //Recipients
        $phpmailer->setFrom('pa.cms.test@gmail.com', 'PCR Contact');
        $phpmailer->addAddress($user->getEmail());     //Add a recipient

        //Content
        $phpmailer->isHTML(true);
    }
}
