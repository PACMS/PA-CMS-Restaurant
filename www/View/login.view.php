<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Connexion</h1>
    <!-- <h2>Essai</h2> -->
    <?php $this->includePartial("form", $user->getLoginForm()); ?>
    <a href="lostPassword"><button class="button">Mot de passe oublié</button></a>
</body>
</html>

