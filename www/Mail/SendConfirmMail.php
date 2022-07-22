<?php

namespace App\Mail;

class SendConfirmMail extends Mail
{
    protected array $data = [];

    public function destination(): string
    {
        return $this->data['email'];
    }

    public function object(): string
    {
        return 'Valider votre inscription !';
    }

    public function message(): string
    {
        $actualDateTime = new \DateTime();
        $actualDateTime = $actualDateTime->format('YmdHis');
        $message = $_SERVER["REQUEST_SCHEME"] . "://" . APP_URL . "/" . "verifyToken?token=" . $this->data['token'] . '&email=' . $this->data['email'] . '&date=' . $actualDateTime;

        return "
            <h1>Bienvenue sur le site de la PCR !</h1>
            <p>
                Bonjour {$this->data['firstname']} {$this->data['lastname']},<br>
                Vous venez de vous inscrire sur le site de la PCR.<br>
                Afin de valider votre inscription, veuillez cliquer sur le lien ci-dessous :<br>
                <a href='{$message}'>Confirmer votre inscription</a>
            </p>
        ";
    }
}