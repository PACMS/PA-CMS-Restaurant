<?php

namespace App\Mail;

class ActivePasswordMail extends Mail
{
    protected array $data = [];

    public function destination(): string
    {
        return $this->data['email'];
    }

    public function object(): string
    {
        return 'Activer votre compte';
    }

    public function message(): string
    {
        return "
            <p>Pour activer votre compte et choisir un mot de passe, merci de cliquer sur : <br>
            <a href='" . $_SERVER['REQUEST_SCHEME'] . '://' . APP_URL . '/' . "resetPassword?token=" . $this->data['token'] . "'>Choisir un mot de passe</a> <br>
            <b>Ce mail n'est valable qu'une heure !</b></p>
        ";
    }
}