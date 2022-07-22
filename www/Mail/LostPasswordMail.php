<?php

namespace App\Mail;

class LostPasswordMail extends Mail
{
    protected array $data = [];

    public function destination(): string
    {
        return $this->data['email'];
    }

    public function object(): string
    {
        return 'Mot de passe oublié';
    }

    public function message(): string
    {
        return "
            <h1>Mot de passe oublié</h1>
            <p>Bonjour,</p>
            <p>Vous avez demandé un nouveau mot de passe.</p>
            <p>Vous pouver le changer en cliquant ici : ". $_SERVER["REQUEST_SCHEME"] . "://" . APP_URL . "/" . "resetPassword?token=" . $this->data['token'] . "</p>
            <p>Vous pouvez vous connecter à votre compte en utilisant ce mot de passe.</p>
            <p>Cordialement,</p>
            <p>L'équipe PCR</p>
        ";
    }
}