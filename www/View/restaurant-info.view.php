<main class="flex pageDashboard">
    <?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
    <?php $this->includePartial("topBar", ["title" => "Informations"]); ?>
    <?php if($_SESSION["user"]["role"] == "admin"): ?>

        <div id="restaurant-delete">
            <a href="/restaurant/delete" id="delete">Supprimer</a>
        </div>
        <?php $this->includePartial("form", $restaurant->getCompleteUpdateRestaurantForm()); ?>
        <?php endif; ?>
    </section>
</main>

<script>
    // get element input type submit
    const submitForm = document.getElementById("restaurant-form");

    const submit = submitForm.querySelector("input[type='submit']");
    submit.setAttribute("class", "cta-button --cta-button-save");
    const buttonsDiv = document.createElement("div");
    buttonsDiv.setAttribute("id", "buttonsDiv");
    const form = document.getElementById("restaurant-form");
    form.appendChild(buttonsDiv);
    // move sumbit to buttonsDiv
    const deleteForm = document.getElementById("restaurant-delete");
    const deleteButton = deleteForm.querySelector("#delete");
    deleteButton.setAttribute("class", "cta-button --cta-button-delete");
    buttonsDiv.appendChild(deleteForm);
    buttonsDiv.appendChild(submit);
</script>