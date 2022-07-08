<main class="flex pageDashboard">
    <?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
    <?php $this->includePartial("topBar", ["title" => "Information de l'ingrédient"]); ?>

        <!-- <form  id="food-delete" method="POST" action="/restaurant/food/delete">
            <input name="id" id="id" type="hidden" value="<?= $oneFood["id"]; ?>">
            <input type="submit" id="delete" value="Supprimer">
        </form> -->
        <?php $this->includePartial("form", $food->deleteFoodForm(intval($oneFood["id"]))); ?>
        <?php $this->includePartial("form", $food->updateFoodForm()); ?>
    </section>
</main>

<script>
    // get element input type submit
    const submitForm = document.getElementById("restaurant-form");

    const submit = submitForm.querySelector("input[type='submit']");
    submit.setAttribute("class", "cta-button --cta-button-save");
    const buttonsDiv = document.createElement("div");
    buttonsDiv.setAttribute("id", "buttonsDiv");
    buttonsDiv.setAttribute("class", "flex align-items-center ");
    const form = document.getElementById("restaurant-form");
    form.appendChild(buttonsDiv);
    // move sumbit to buttonsDiv
    const deleteForm = document.getElementById("food-delete");
    const deleteButton = deleteForm.querySelector("input[type='submit']");
    deleteButton.setAttribute("class", "cta-button --cta-button-delete");
    buttonsDiv.appendChild(deleteForm);
    buttonsDiv.appendChild(submit);
</script>