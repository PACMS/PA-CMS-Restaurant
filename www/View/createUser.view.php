<main class="flex pageDashboard">
    <?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
    <?php $this->includePartial("topBar", ["title" => "Créer un utilisateur"]); ?>
        <div class="container">
            <?php if ($errors): ?>
                <?php foreach ($errors as $error):  ?>
                    <p style="color: red"><?= $error ?></p>
                <?php endforeach ?>
            <?php endif ?>
        </div>
        <section class="usersTableHeader flex justify-content-between">
            <?php $this->includePartial("form", $user->getUserCreationForm()); ?>
        </section>
    </section>
</main>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>