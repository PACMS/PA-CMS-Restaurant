<main class="flex pageDashboard">
<?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="cards-page">
    <?php $this->includePartial("topBar", ["title" => "Cartes"]); ?>
        <section class="list-cards">
            <?php foreach ($cartes as $key => $value) : ?>
                <article class="card">
                    <img src="../public/src/pizza.jpg" alt="graph" />
                    <footer>
                        <h3 class="linkMeal" data-id-card="<?= $value->getId() ?>"><?= $value->getName() ?></h3>
                        <h6><?= $restaurant->getName() ?></h6>
                        <button id="state-card" class="<?= $value->getStatus() ? "active" : "" ?>"><?= $value->getStatus() ? "Activé" : "Désactivé" ?></button>
                    </footer>
                    </a>
                    <a href="?id=<?= $value->getId() ?>">
                        <svg id="edit-card" width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_641_4396)">
                                <path d="M3.36548 16.668V19.7195H7.12968L18.2316 10.7196L14.4674 7.66814L3.36548 16.668ZM21.1426 8.35981C21.534 8.04246 21.534 7.52981 21.1426 7.21245L18.7937 5.30833C18.4022 4.99097 17.7698 4.99097 17.3784 5.30833L15.5414 6.79745L19.3056 9.84894L21.1426 8.35981Z" fill="#0051EF" />
                            </g>
                            <defs>
                                <clipPath id="clip0_641_4396">
                                    <rect width="24.0909" height="21.9707" fill="white" transform="translate(0.354004 0.189453)" />
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                </article>
            <?php endforeach; ?>
            <article class="card create">
                <a href="/restaurant/carte/create">
                    <main>
                        <svg id="add-card" width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <line x1="45" y1="26" x2="45" y2="63" stroke="#0051EF" stroke-width="8" stroke-linecap="round" />
                            <line x1="26" y1="45" x2="63" y2="45" stroke="#0051EF" stroke-width="8" stroke-linecap="round" />
                            <circle cx="45" cy="45" r="44.5" fill="white" fill-opacity="0.1" stroke="#007AFF" />
                        </svg>
                    </main>
                    <footer>
                        <h3>Ajouter une carte</h3>
                        <h6><?= $restaurant->getName() ?></h6>
                        <button id="state-card" class="active">Créer</button>
                    </footer>
                </a>
            </article>
        </section>
    </section>
</main>

<script>
    $("h3.linkMeal").click(function(e) {
        $.post("/restaurant/carte/meals/sendId", {
            id: e.target.getAttribute("data-id-card")
        }, function() {
            location.href = '/restaurant/carte/meals';
        });
    });
</script>