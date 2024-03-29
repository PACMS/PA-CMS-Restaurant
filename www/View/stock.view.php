<main class="flex pageDashboard">
    <?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
    <?php $this->includePartial("topBar", ["title" => "Stocks"]); ?>
        <section style="padding-right: 4%;">
            <div id="Add" style="display: flex; width: 100%; justify-content: right">
                <button id="addProduct" style="padding: 10px 0; width:200px; background-color : #0051EF; color: white; border: none; border-radius: 11px; font-size: 16px; margin-right: 100px; text-align: center; text-decoration: none;">Ajouter un produit</button>
            </div>

            <div class="modal hidden addProduct">
                <?php $this->includePartial("form", $food->getAddProduct()); ?>
            </div>



            <div style=" height: 100%; width: 100%; margin:auto; padding-right: 4%; margin-top: 100px ">
                <?php foreach ($allFoods as $value) : ?>
                    <div class="flex align-item-center" style="gap: 10px">
                        <div class="flex align-items-center " style="gap: 10px">
                            <p id="foodQuantity" data-value="<?= $value["quantity"] ?>"><?= $value["quantity"] ?> </p>
                            <p id="foodName" data-value="<?= $value["name"] ?>"><?= $value["name"] ?></p>
                            <form method="POST" action="/restaurant/food">
                                <input type="hidden" name="id" value="<?= $value["id"] ?>"></input>
                                <button type="submit" style="padding: 10px 0; width:100px; background-color : #0051EF; color: white; border: none; border-radius: 11px; font-size: 16px; margin-right: 100px; text-align: center; text-decoration: none;">Modifier</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

    </section>
</main>

<script defer>
    $('button#deleteFood').click(function(e) {
        $.post("/restaurant/food/delete", {
            id: e.currentTarget.getAttribute("food-id")
        }).done(function(data) {
            location.reload();
        });
    });

    $("div.modal > form").append("<p class='close'>close</p>");

    $("div.modal > form > p.close").click(function(e) {
        $("div.modal").hide();
    })

    $("button#addProduct").click(function(e) {
        $("div.modal.addProduct").toggle();
    });
</script>