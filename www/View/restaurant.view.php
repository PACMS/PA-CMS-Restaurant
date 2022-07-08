<?php
if (isset($errors)) :
    foreach ($errors as $error) :
        echo $error;
        echo '<br>';
    endforeach;
endif;
?>

<main class="flex pageDashboard">
    <?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
        <section class="navbar">
            <div class="flex align-items-center">
                <img src="https://images.unsplash.com/photo-1527980965255-d3b416303d12?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTgwOTN8MHwxfHNlYXJjaHw2fHxhdmF0YXJ8ZW58MHx8fHwxNjQ1NDQ1MjIx&ixlib=rb-1.2.1&q=80&w=1080" alt="Avatar">
                <h1><?= $oneRestaurant["name"] ?></h1>
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
        <section style="padding-right: 4%;">
            <div style=" height: 100%; width: 100%; margin:auto; padding-right: 4%; margin-top: 100px ">
                <div class="restaurants-container">
                    <div class="restaurant-card">
                        <img src="../public/assets/img/restauOptions/mentions-legales.jpg" alt="information" />
                        <div class="bandeau">
                            <p>Pages</p>
                            <button><a href="/restaurant/page">Accéder</a></button>
                        </div>
                    </div>
                    <div class="restaurant-card">
                        <img src="../public/assets/img/restauOptions/informations.png" alt="information" />
                        <div class="bandeau">
                            <p>Informations</p>
                            <button><a href="/restaurant/information">Accéder</a></button>
                        </div>
                    </div>
                    <div class="restaurant-card">
                        <img src="../public/assets/img/restauOptions/cartes.jpg" alt="cartes" />
                        <div class="bandeau">
                            <p>Cartes</p>
                            <button><a href="/restaurant/cartes">Accéder</a></button>
                        </div>
                    </div>
                    <div class="restaurant-card">
                        <img src="../public/assets/img/restauOptions/salle.jpg" alt="salle" />
                        <div class="bandeau">
                            <p>Salle</p>
                            <button><a href="/restaurants">Accéder</a></button>
                        </div>
                    </div>
                    <div class="restaurant-card">
                        <img src="../public/assets/img/restauOptions/stock.jpg" alt="stock" />
                        <div class="bandeau">
                            <p>Stock</p>
                            <button><a href="/restaurant/stock">Accéder</a></button>
                        </div>
                    </div>
                    <form class="restaurant-card" method="POST" action="restaurant/reservation">
                        <img src="../public/assets/img/restauOptions/reservations.jpg" alt="reservations" />
                        <div class="bandeau">
                            <p>Réservation</p>
                            <button><a href="/reservation">Accéder</a></button>
                        </div>
                </div>
                <div class="restaurant-card">
                    <img src="../public/assets/img/restauOptions/comments.png" alt="commentaires" />
                    <div class="bandeau">
                        <p>Commentaires</p>
                        <button><a href="/restaurant/comments">Accéder</a></button>
                    </div>
                    </form>

                    <div class="restaurant-card">
                        <img src="../public/assets/img/restauOptions/mentions-legales.jpg" alt="mentions-legales" />
                        <div class="bandeau">
                            <p>Mentions légales</p>
                            <button>
                                <a href="/restaurants">Accéder</a>
                            </button>
                        </div>
                    </div>
                    <div class="restaurant-card">
                        <img src="../public/assets/img/restauOptions/stats.jpg" alt="statistiques" />
                        <div class="bandeau">
                            <p>Statistiques</p>
                            <button>
                                <a href="/restaurant/statistiques">Accéder</a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    </section>
</main>