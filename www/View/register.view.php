 <!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="./public/dist/main.css">
</head>

<?php
    if (isset($errors)):
        foreach ($errors as $error):
            echo $error;
            echo '<br>';
        endforeach;
    endif;
?>

<h1>S'inscrire</h1>
<button class="button">TEST CSS</button>

<a href='https://accounts.google.com/o/oauth2/v2/auth?scope=<?= urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email') ?>&access_type=offline&response_type=code&redirect_uri=<?= urlencode(REDIRECT_URI_GOOGLE) ?>&client_id=<?= PUBLIC_KEY_GOOGLE ?>'>Google</a>
<a href='https://www.facebook.com/v13.0/dialog/oauth?client_id=<?= PUBLIC_KEY_FACEBOOK ?>&redirect_uri=<?= urlencode(REDIRECT_URI_FACEBOOK) ?>&scope=email'>Facebook</a>


<?php $this->includePartial("form", $user->getCompleteRegisterForm()); ?>