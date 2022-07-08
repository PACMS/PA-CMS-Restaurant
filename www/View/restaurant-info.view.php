<main class="flex pageDashboard">
    <?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
        <section class="navbar">
            <div class="flex align-items-center">
                <!-- <img src="https://images.unsplash.com/photo-1527980965255-d3b416303d12?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTgwOTN8MHwxfHNlYXJjaHw2fHxhdmF0YXJ8ZW58MHx8fHwxNjQ1NDQ1MjIx&ixlib=rb-1.2.1&q=80&w=1080" alt="Avatar"> -->
                <h1>Informations</h1>
            </div>
            <article class="flex align-items-center gap-20">
                <a href="/profile">
                    <p class="m-0"><i class="fas fa-user"></i></p>
                </a>
                <button style="background: none; border: none">
                    <i class="far fa-moon"></i>
                </button>
                <button style="background: none; border: none">
                    <i class="fas fa-toggle-off"></i>
                </button>
            </article>
        </section>

        <div id="restaurant-delete">
            <a href="/restaurant/delete" id="delete">Supprimer</a>
        </div>
        <?php $this->includePartial("form", $restaurant->getCompleteUpdateRestaurantForm()); ?>
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