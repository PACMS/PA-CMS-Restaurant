<main class="flex pageDashboard">
    <?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
    <?php $this->includePartial("topBar", ["title" => "Restaurants"]); ?>
        <section style="padding-right: 4%;">

            <div style="display: flex; width: 100%; justify-content: right">
                <a href="/restaurant/create" style="padding: 10px 0; width:200px; background-color : #0051EF; color: white; border: none; border-radius: 11px; font-size: 16px; margin-right: 100px; text-align: center; text-decoration: none;">Ajouter un restaurant</a>

            </div>
            <div style=" height: 100%; width: 100%; margin:auto; padding-right: 4%; margin-top: 100px ">
                <div class="restaurants-list">
                    <?php if (!empty($restaurants)) : ?>
                        <?php foreach ($restaurants as $value) : ?>
                            <div class="restaurant-card">

                                <img src="../public/assets/img/pizza.jpg" alt="graph" />
                                <div class="bandeau">
                                    <p><?= $value["name"] ?></p>
                                    <?php $this->includePartial("form", $restaurant->selectRestaurant($value["id"])); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </section>
    </section>
</main>