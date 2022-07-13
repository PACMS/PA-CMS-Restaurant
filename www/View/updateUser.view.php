<main class="flex pageDashboard">
    <?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
        <?php if ($errors): ?>
            <?php foreach ($errors as $error):  ?>
                <p style="color: red"><?= $error ?></p>
            <?php endforeach ?>
        <?php endif ?>
        <?php $this->includePartial("topBar", ["title" => "Modifier un utilisateur"]); ?>
        <section class="usersTableHeader flex justify-content-center align-items-center">
            <?php $this->includePartial("form", $user->getUpdateUsersForm()) ?>
        </section>
    </section>
</main>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>