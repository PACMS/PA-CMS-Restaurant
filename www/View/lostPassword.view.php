<main class="forgetPassword">
    <section>
        <div style="color: red; border: none">
            <?php if ($errors): ?>
                <?php foreach ($errors as $error):  ?>
                    <p><?= $error ?></p>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </section>
    <section class="container-forgetPassword">
        <h1>Comment souhaitez-vous accéder à votre espace personnel ?</h1>
        <div id="passwordChoice">
            <h3 id="withoutPassword" class="active">Sans mot de passe</h3>
            <h3 id="withPassword">avec mot de passe</h3>
        </div>
        <p id="without-pwd" class="active">Accéder à votre espace personnel sans mot de passe en renseignant simplement votre email lié à votre compte.</p>
        <p id="with-pwd">Accéder à votre espace personnel avec un mot de passe en renseignant simplement votre email lié à votre compte.</p>

        <?php $this->includePartial("form", $user->getLostPasswordForm()); ?>
    </section>
</main>



