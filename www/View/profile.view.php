<main class="flex pageDashboard">
<?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
        <?php $this->includePartial("topBar", ["title" => "Profil"]); ?>
        <section class="formProfile flex flex-column">

            <div class="flex flex-row align-items-center">
                <div class="profileImg">
                    <img src="https://images.unsplash.com/photo-1527980965255-d3b416303d12?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTgwOTN8MHwxfHNlYXJjaHw2fHxhdmF0YXJ8ZW58MHx8fHwxNjQ1NDQ1MjIx&ixlib=rb-1.2.1&q=80&w=1080" alt="Avatar">
                </div>

                <div class="flex-column">
                    <p class="title"><?= $_SESSION['user']['firstname'] ?></p>
                    <p class="role top-32"><?= $_SESSION['user']['role'] == 'admin' ? "Admin" : "Employé"; ?></p>
                </div>

                <button id="editProfile">
                    <i class="far fa-pen "></i>
                </button>

            </div>

            <div class="container">
                <?php if ($errors): ?>
                    <?php foreach ($errors as $error):  ?>
                        <p style="color: red"><?= $error ?></p>
                    <?php endforeach ?>
                <?php endif ?>
            </div>

            <div class="container justify-center items-center">
                <?php $this->includePartial("form", $user->getFullUpdateUserForm()); ?>

                <button class='btn btn-cancel mr-4 hidden' id='btncancel'>Annuler </button>

                <p class='greytext'>Profil modifié le <?= date("d/m/Y à H\hi", strtotime($data->updatedAt . '+2 hours')) ?> </p>
            </div>
        </section>
    </section>

</main>
