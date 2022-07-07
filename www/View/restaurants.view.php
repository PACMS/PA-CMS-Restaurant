<main class="flex pageDashboard">
<?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
        <section class="navbar">
            <div class="flex align-items-center">
                <!-- <img src="https://images.unsplash.com/photo-1527980965255-d3b416303d12?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTgwOTN8MHwxfHNlYXJjaHw2fHxhdmF0YXJ8ZW58MHx8fHwxNjQ1NDQ1MjIx&ixlib=rb-1.2.1&q=80&w=1080" alt="Avatar"> -->
                <h1>Restaurants</h1>
            </div>
            <article class="flex align-items-center gap-20">
                <a href="profile">
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
        <section style="padding-right: 4%;">

            <div style="display: flex; width: 100%; justify-content: right">
                <a href="/restaurant/create" style="padding: 10px 0; width:200px; background-color : #0051EF; color: white; border: none; border-radius: 11px; font-size: 16px; margin-right: 100px; text-align: center; text-decoration: none;">Ajouter un restaurant</a>

            </div>
            <div style=" height: 100%; width: 100%; margin:auto; padding-right: 4%; margin-top: 100px ">
                <div class="restaurants-list">
                    <?php foreach ($restaurants as $key => $value) : ?>
                        <div class="restaurant-card">

                            <img src="../public/assets/img/pizza.jpg" alt="graph" />
                            <div class="bandeau">
                                <p><?= $value["name"] ?></p>
                                <?php $this->includePartial("form", $restaurant->selectRestaurant($value["id"])); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </section>
    </section>
</main>