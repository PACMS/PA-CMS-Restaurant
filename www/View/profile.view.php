<main class="flex pageDashboard">
<?php $this->includePartial("profil-sidebar"); ?>
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

            <div class="container justify-center items-center">
                <form action="profile/update" method="post">
                    <div class="flex flex-row justify-content-between w-full">
                        <!-- Prenom -->
                        <div class="flex flex-column">
                            <label class="greytext" for="firstname">Prénom</label>
                            <input type="text" id="firstname" name="firstname" value="<?php echo $userInfos['firstname'] ?>" disabled>
                        </div>

                        <!-- Nom de famille -->
                        <div class="flex flex-column">
                            <label class="greytext" for="lastname">Nom de famille</label>
                            <input type="text" id="lastname" name="lastname" value="<?php echo $userInfos['lastname'] ?>" disabled>
                        </div>
                    </div>
                    <div class="flex flex-column w-full">
                    <!-- Adresse mail -->
                    <label class="greytext mt-8" for="email">Adresse mail</label>
                    <input type="email" id="email" name="email" value="<?php echo $userInfos['email'] ?>" disabled>

                    <!-- Numéro de telephone-->
                    <!-- <label class="greytext mt-8" for="phoneNumber">Numero de téléphone</label>
                    <input type="tel" id="phoneNumber" name="phoneNumber" value="01 01 01 01 01" disabled> -->
                    </div>
                    <div id="sectionButton" class="flex flex-row mt-8 justify-content-end w-full">

                    </div>
                </form>
                <?php echo "<p class='greytext'>Profil modifié le ". date("d/m/Y à H\hi", strtotime($userInfos['updatedAt'] . '+2 hours')) . "</p>"; ?>
            </div>
            <?php echo "<p class='greytext'>Inscrit depuis le ". date("d/m/Y à H\hi", strtotime($userInfos['createdAt'] . '+2 hours')) . "</p>"; ?>
        </section>
    </section>

</main>
