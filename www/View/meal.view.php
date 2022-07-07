<header id="meals">
    <article>
        <h1><a href="/restaurant/cartes"><?= $restaurantName ?></a></h1>
        <h3><?= $carteName ?></a></h3>
    </article>
    <article id="Add">
        <button id="addCategorie">Ajouter une catégorie</button>
        <button id="addMeal">Ajouter un menu</button>
    </article>
</header>
<main id="meals">
   
    <div class="modal hidden addCategorie">
        <?php $this->includePartial("form", $categorie->getAddCategorie()); ?>
    </div>

    <div class="modal hidden addMeal">
        <?php $this->includePartial("form",  $meal->getAddMeal($categories, $food)); ?>
    </div>
    <section id="meals-menus" class="">
        <?php foreach($categories as $categorieKey => $value) : ?>
            <?php if ($value["id_carte"] == $_SESSION["id_card"]) : ?>
                <article>
                    <div class="flex justify-content-between align-items-center">
                        <?php $this->includePartial("form", $categorie->getUpdateCategorie($value["name"], $value["id"])); ?>
                        <h1>
                            <?= ($value["name"]) ?> <span id="deleteCategorie" class="hidden" data-id-categorie="<?= $value["id"] ?>">Supprimer</span>
                        </h1>
                        <figure id="editCategorie">
                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.6931 0C16.416 0 16.1386 0.102599 15.9274 0.308388L14.0787 2.10526L18.4106 6.31579L20.2593 4.51891C20.6828 4.10734 20.6828 3.44095 20.2593 3.03043L17.4588 0.308388C17.2471 0.102599 16.9702 0 16.6931 0ZM12.4543 3.68421L0 15.7895V20H4.33192L16.7862 7.89474L12.4543 3.68421Z" fill="black"/>
                            </svg>
                        </figure>
                    </div>
                    <ul>
                        <?php foreach($allMeals as $key => $mealValue) : ?>

                            <?php if ($mealValue["id_categories"] === $value["id"]) : ?>

                                <li>
                                    <?php $this->includePartial("form",  $meal->getUpdateMeal($mealValue)); ?>
                                    <article class="flex flex-column" data-id-categorie="<?= $mealValue["id_categories"] ?>">
                                        <main class="flex justify-content-between align-items-center">
                                            <h1 data-value="<?= $mealValue["name"] ?>"><?= $mealValue["name"] ?> <span class="hidden" id="editMeal" data-id-meal="<?= $mealValue["id"] ?>">Editer</span><span id="deleteMeal" class="hidden" data-id-meal="<?= $mealValue["id"] ?>">Supprimer</span></h1>
                                            <h3 data-value="<?= $mealValue["price"] ?>"><?= $mealValue["price"] ?> &euro;</h3>
                                        </main>
                                        <footer>
                                            <p><?= ($mealValue["description"]) ?></p>
                                        </footer>
                                    </article>
                                </li>

                            <?php endif ?>

                        <?php endforeach; ?>
                    </ul>
                </article>
            <?php endif ?>

        <?php endforeach; ?>
       
    </section>

</main>