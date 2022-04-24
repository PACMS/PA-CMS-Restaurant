
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
        <div style=" height: 100%; width: 100%; margin:auto; padding-right: 2.5%; padding-top: 100px ">
            <div  style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); grid-gap: 0 50px;"  >
                <?php foreach ($restaurant as $key => $value) : ?>
                    <div class="restaurant-card">
                        <img src="../public/src/pizza.jpg" alt="graph" />
                        <div class="bandeau">
                            <p><?= $value["name"] ?></p>
                            <button>Modifier</button>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    </section>
</main>

