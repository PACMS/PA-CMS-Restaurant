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
                        <h1 data-value="<?= ($value["name"]) ?>">
                            <?= ($value["name"]) ?> <span id="deleteCategorie" class="hidden" data-id-categorie="<?= $value["id"] ?>">Supprimer</span>
                        </h1>
                        <figure id="editCategorie" data-id-categorie="<?= $value["id"] ?>">
                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.6931 0C16.416 0 16.1386 0.102599 15.9274 0.308388L14.0787 2.10526L18.4106 6.31579L20.2593 4.51891C20.6828 4.10734 20.6828 3.44095 20.2593 3.03043L17.4588 0.308388C17.2471 0.102599 16.9702 0 16.6931 0ZM12.4543 3.68421L0 15.7895V20H4.33192L16.7862 7.89474L12.4543 3.68421Z" fill="black"/>
                            </svg>
                        </figure>
                    </div>
                    <ul>
                        <?php foreach($allMeals as $key => $value) : ?>

                            <?php if ($value["id_categories"] === $categorie["id"]) : ?>

                                <li>
                                    <article class="flex flex-column" data-id-categorie="<?= $value["id_categories"] ?>">
                                        <main class="flex justify-content-between align-items-center">
                                            <h1 data-value="<?= $value["name"] ?>"><?= $value["name"] ?> <span class="hidden" id="editMeal" data-id-meal="<?= $value["id"] ?>">Editer</span><span id="deleteMeal" class="hidden" data-id-meal="<?= $value["id"] ?>">Supprimer</span></h1>
                                            <h3 data-value="<?= $value["price"] ?>"><?= $value["price"] ?> &euro;</h3>
                                        </main>
                                        <footer>
                                            <p><?= ($value["description"]) ?></p>
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


<script defer>

    $("div.modal > form").append("<p class='close'>close</p>");

    $("div.modal > form > p.close").click(function(e) {
        $("div.modal").hide();
    })

    $("button#addCategorie").click(function(e) {
        $("div.modal.addCategorie").toggle();
    });

    $("button#addMeal").click(function(e) {
        $("div.modal.addMeal").toggle();
    });

    $('figure#editCategorie').click(function(e) {
       
        $(e.target.parentElement.children[1]).hide();
        $(e.target.parentElement.children[2]).hide();
        $(e.target.parentElement.children[0]).removeClass("hidden")

    });

    $('span#editMeal').click(function(e) {

        console.log("click");
        let idMeal = e.target.getAttribute("data-id-meal");
        let name = $(e.target.parentElement).attr("data-value");
        let price = $(e.target.parentElement.parentElement.children[1]).attr("data-value");
        let description = $(e.target.parentElement.parentElement.parentElement.children[1].children[0]).text();
        let idCategorie = $(e.target.parentElement.parentElement.parentElement).attr("data-id-categorie");
        $(e.target.parentElement.parentElement.parentElement).hide();
        console.log(name, price, description);
        $(e.target.parentElement.parentElement.parentElement).replaceWith(function() {
            return $(`<form method="POST" action="/restaurant/carte/meals/updateMeal">
            <label for="name">Nom du menu</label>
            <input type="text" name="name" value="${name}" />
            <label for="price">Prix</label>
            <input type="text" name="price" value="${price}" />
            <label for="description">Description</label>
            <textarea name="description">${description}</textarea>
            <input type="hidden" name="id" value="${idMeal}" />
            <input type="hidden" name="IdCarte" value="${<?= $_SESSION["id_card"] ?>}" />
            <input type="hidden" name="IdCategorie" value="${idCategorie}" />
            <button type="submit">Modifier</button>
            </form>`);
        });
    });

    $('span#deleteMeal').click(function(e) {
        $.post( "/restaurant/carte/meals/deleteMeal", { id: e.target.getAttribute("data-id-meal") } );
        location.reload();
    });

    $('span#deleteCategorie').click(function(e) {
        $.post( "/restaurant/carte/meals/deleteCategorie", { id: e.target.getAttribute("data-id-categorie") } );
        location.reload();
    });



</script>