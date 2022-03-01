<!-- <h1>Bienvenue dans votre Dashboard</h1> -->
<!-- Welcome <?= $firstname ?> <?= $lastname ?> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.bundle.min.js"></script>
<main class="flex pageDashboard">
    <section class="sidebar">
        <nav class="sidebar-nav">
            <a href="dashboard">
                <img class="sidebar-image" src="https://images.unsplash.com/photo-1554469384-e58fac16e23a?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTgwOTN8MHwxfHNlYXJjaHwzfHxidWlsZGluZ3xlbnwwfHx8fDE2NDUzODA4MTQ&ixlib=rb-1.2.1&q=80&w=1080" alt="Avatar">
                <h2 class="sidebar-title">Nom Entreprise</h2>
            </a>
            <ul class="sidebar-list">

                <li><a href="profile" class="sidebar-button"><i class="far fa-user-circle sidebar-button-picto"></i>Profil</a></li>
                <li><a href="#" class="sidebar-button"><i class="far fa-edit sidebar-button-picto"></i>Thèmes</a></li>
                <li><a href="#" class="sidebar-button"><i class="far fa-chart-bar sidebar-button-picto"></i>Statistiques</a></li>
                <li><a href="#" class="sidebar-button"><i class="far fa-lemon sidebar-button-picto"></i>Restaurants</a></li>
                <li> <a href="#" class="sidebar-button"><i class="far fa-list-alt sidebar-button-picto"></i>Utilisateurs</a></li>
            </ul>
        </nav>
        <button id="navbarButton" class="sidebar-resizer"><i class="far fa-arrow-alt-circle-left"></i>Réduire</button>
    </section>
    <section class="flex flex-column secondPart">
        <div class="navbar">
            <div class="flex align-items-center">
                <img src="https://images.unsplash.com/photo-1527980965255-d3b416303d12?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTgwOTN8MHwxfHNlYXJjaHw2fHxhdmF0YXJ8ZW58MHx8fHwxNjQ1NDQ1MjIx&ixlib=rb-1.2.1&q=80&w=1080" alt="Avatar">
                <h1>Bienvenue sur votre Dashboard</h1>
            </div>
            <article class="flex align-items-center gap-20">
                <a href="profile">
                    <p class="m-0">Jean Pierre<i class="fas fa-user"></i></p>
                </a>
                <button style="background: none; border: none">
                    <i class="far fa-moon"></i>
                </button>
                <button style="background: none; border: none">
                    <i class="fas fa-toggle-off"></i>
                </button>
            </article>
        </div>
        <div class="stats flex justify-content-between border-bottom-solid border-bottom-2 border-bottom-blue">
            <div class="flex gap-30">
                <div class="flex flex-column justify-content-end">
                    <div class="flex gap-7">
                        <strong class="m-0 data">140</strong>
                        <p class="m-0 percentData--warning">-7,00%</p>
                    </div>
                    <small>nombres de vues</small>
                </div>
                <div class="flex flex-column justify-content-end">
                    <div class="flex gap-7">
                        <strong class="data m-0">140</strong>
                        <p class="m-0 percentData--success">+7,00%</p>
                    </div>
                    <small>nouveaux inscrits</small>
                </div>
                <div class="flex flex-column justify-content-end">
                    <div class="flex gap-7">
                        <strong class="data m-0">140</strong>
                        <p class="m-0 percentData--success">+7,00%</p>
                    </div>
                    <small>abonnés à la newsletter</small>
                </div>
            </div>
            <div class="align-self-end">
                <a class="voir-plus-button" href="">Voir plus</a>
            </div>
        </div>
        <div class="grid">
            <div class="row">
                <div class="cols-lg-12 cols-md-12 cols-sm-12">
                    <div class="content green">1</div>
                </div>

            </div>
            <div class="row">

                <div class="cols-lg-6 cols-md-12 cols-sm-12 offset-sm-3 ">
                    <section class="container-preview-cards">
                        <article class="card">
                            <figure>
                                <img src="https://marketplace.canva.com/EAEPN913uPs/1/0/1131w/canva-vert-et-or-case-bordure-g%C3%A9om%C3%A9trique-floral-mariage-menu-DI7xnk_h_VU.jpg" alt="Benefit 3">
                                <footer>
                                    <a class="cta-button--blue">Activé</a>
                                    <h1>menu principal</h1>
                                    <h2>pour Pizza Gogo</h2>
                                </footer>
                            </figure>
                        </article>
                        <article class="card">
                            <figure>
                                <img src="https://marketplace.canva.com/EAEPN913uPs/1/0/1131w/canva-vert-et-or-case-bordure-g%C3%A9om%C3%A9trique-floral-mariage-menu-DI7xnk_h_VU.jpg" alt="Benefit 3">
                                <footer>
                                    <a class="cta-button--blue">Activé</a>
                                    <h1>menu principal</h1>
                                    <h2>pour Pizza Gogo</h2>
                                </footer>
                            </figure>
                        </article>
                        <article class="card">
                            <figure>
                                <img src="https://marketplace.canva.com/EAEPN913uPs/1/0/1131w/canva-vert-et-or-case-bordure-g%C3%A9om%C3%A9trique-floral-mariage-menu-DI7xnk_h_VU.jpg" alt="Benefit 3">
                                <footer>
                                    <a class="cta-button--blue">Activé</a>
                                    <h1>menu principal</h1>
                                    <h2>pour Pizza Gogo</h2>
                                </footer>
                            </figure>
                        </article>
                        <article class="card">
                            <figure>
                                <img src="https://marketplace.canva.com/EAEPN913uPs/1/0/1131w/canva-vert-et-or-case-bordure-g%C3%A9om%C3%A9trique-floral-mariage-menu-DI7xnk_h_VU.jpg" alt="Benefit 3">
                                <footer>
                                    <a class="cta-button--blue">Activé</a>
                                    <h1>menu principal</h1>
                                    <h2>pour Pizza Gogo</h2>
                                </footer>
                            </figure>
                        </article>
                    </section>
                </div>
                <div class="cols-lg-6 cols-md-12 cols-sm-12 offset-sm-3">
                    <div class="content purple">1</div>
                </div>
            </div>
            <div class="row">
                
            </div>

        </div>

    </section>
</main>