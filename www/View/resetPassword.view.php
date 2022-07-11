<div style="color: red; border: none">
    <?php if ($errors): ?>
        <?php foreach ($errors as $error):  ?>
            <p><?= $error ?></p>
        <?php endforeach ?>
    <?php endif ?>
</div>

<?php

$this->includePartial("form", $user->getResetPasswordForm());
