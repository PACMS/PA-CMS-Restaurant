<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="./public/dist/main.css">
</head>

<h1>S'inscrire</h1>
<button class="button">TEST CSS</button>

<a href='https://accounts.google.com/o/oauth2/v2/auth?scope=<?= urlencode('https://www.googleapis.com/auth/userinfo.profile') ?>&access_type=offline&response_type=code&redirect_uri=<?= urlencode('http://localhost/connected') ?>&client_id=<?= PUBLIC_KEY_GOOGLE ?>'>Se connecter avec Google</a>


<?php $this->includePartial("form", $user->getCompleteRegisterForm()); ?>