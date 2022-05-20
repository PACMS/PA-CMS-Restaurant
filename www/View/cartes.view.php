
<main class="flex">
    <section class="sidebar">
        <nav class="sidebar-nav">
            <a href="dashboard">
                <img class="sidebar-image" src="https://images.unsplash.com/photo-1554469384-e58fac16e23a?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTgwOTN8MHwxfHNlYXJjaHwzfHxidWlsZGluZ3xlbnwwfHx8fDE2NDUzODA4MTQ&ixlib=rb-1.2.1&q=80&w=1080" alt="Avatar">
                <h2 class="sidebar-title">Nom Entreprise</h2>
            </a>
            <ul class="sidebar-list">
                <li><a href="profile" class="sidebar-button"><i class="far fa-user-circle sidebar-button-picto"></i><span>Profil</span></a></li>
                <li><a href="#" class="sidebar-button"><i class="far fa-edit sidebar-button-picto"></i><span>Thèmes</span></a></li>
                <li><a href="#" class="sidebar-button"><i class="far fa-chart-bar sidebar-button-picto"></i><span>Statistiques</span></a></li>
                <li><a href="/restaurants" class="sidebar-button"><i class="far fa-lemon sidebar-button-picto"></i><span>Restaurants</span></a></li>
                <li> <a href="#" class="sidebar-button"><i class="far fa-list-alt sidebar-button-picto"></i><span>Utilisateurs</span></a></li>
            </ul>
        </nav>
        <button id="navbarButton" class="sidebar-resizer"><i class="far fa-arrow-alt-circle-left"></i></button>
    </section>
    <div id="pseudo-element"></div>
    <section class="cards-page">
        <section class="navbar">
            <div class="flex align-items-center">
                <!-- <img src="https://images.unsplash.com/photo-1527980965255-d3b416303d12?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTgwOTN8MHwxfHNlYXJjaHw2fHxhdmF0YXJ8ZW58MHx8fHwxNjQ1NDQ1MjIx&ixlib=rb-1.2.1&q=80&w=1080" alt="Avatar"> -->
                <h1>Cartes</h1>
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
        <section class="list-cards">
            <?php foreach ($cartes as $key => $value) : ?>
                <article class="card">
                    <img src="../public/src/pizza.jpg" alt="graph" />
                        <footer>
                            <a href="carte/meals" class="linkMeal" data-id-card="<?= $value["id"] ?>">
                                <h3><?= $value["name"] ?></h3>
                            </a>
                            <h6>Pour pizza gogo</h6>
                            <button id="state-card" class="<?= $value["status"] ? "active" : "" ?>"><?= $value["status"] ? "Activé" : "Désactivé" ?></button>
                        </footer>
                    </a>
                    <a href="?id=<?= $value["id"] ?>">
                        <svg id="edit-card" width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_641_4396)">
                            <path d="M3.36548 16.668V19.7195H7.12968L18.2316 10.7196L14.4674 7.66814L3.36548 16.668ZM21.1426 8.35981C21.534 8.04246 21.534 7.52981 21.1426 7.21245L18.7937 5.30833C18.4022 4.99097 17.7698 4.99097 17.3784 5.30833L15.5414 6.79745L19.3056 9.84894L21.1426 8.35981Z" fill="#0051EF"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_641_4396">
                            <rect width="24.0909" height="21.9707" fill="white" transform="translate(0.354004 0.189453)"/>
                            </clipPath>
                            </defs>
                        </svg>
                    </a>
                </article>
            <?php endforeach; ?>
            <article class="card create">  
                <a href="/carte/create">
                    <main>
                        <svg id="add-card" width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <line x1="45" y1="26" x2="45" y2="63" stroke="#0051EF" stroke-width="8" stroke-linecap="round"/>
                            <line x1="26" y1="45" x2="63" y2="45" stroke="#0051EF" stroke-width="8" stroke-linecap="round"/>
                            <circle cx="45" cy="45" r="44.5" fill="white" fill-opacity="0.1" stroke="#007AFF"/>
                        </svg>
                    </main>
                    <footer>
                        <h3>Ajouter une carte</h3>
                        <h6>Pour pizza gogo</h6>
                        <button id="state-card" class="active">Créer</button>
                    </footer>
                </a>
            </article>
        </section>
    </section>
</main>

<script>
    $(".linkMeal").click(function(e) {
        $.post( "/carte/meals/sendId", { id: e.target.parentElement.getAttribute("data-id-card") } );
    });
</script>

