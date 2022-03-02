<!-- <h1>Bienvenue dans votre Dashboard</h1> -->


<div class="flex pageDashboard">
    <div class="flex flex-column sidebar justify-content-between align-items-stretch flex-wrap">
        <div class="flex flex-column align-items-center">
            <a href="dashboard">
                <img class="companyProfileImg" src="https://images.unsplash.com/photo-1554469384-e58fac16e23a?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTgwOTN8MHwxfHNlYXJjaHwzfHxidWlsZGluZ3xlbnwwfHx8fDE2NDUzODA4MTQ&ixlib=rb-1.2.1&q=80&w=1080" alt="Avatar">
                <h2 class="lg-hidden">Nom Entreprise</h2>
            </a>
            <a href="profile" class="lg-hidden"><button><i class="far fa-user-circle"></i>Profil</button></a>
            <a href="profile" class="lg-block hidden" style="height: 77px"><i class="far fa-user-circle" style="text-center"></i></a>
            <a href="#"><button><i class="far fa-edit"></i>Thèmes</button></a>
            <a href="#"><button><i class="far fa-chart-bar"></i>Statistiques</button></a>
            <a href="#"><button><i class="far fa-lemon"></i>Restaurants</button></a>
            <a href="#"><button><i class="far fa-list-alt"></i>Utilisateurs</button></a>
        </div>
        <p class="align-self-end"> <button id="navbarButton"><i class="far fa-arrow-alt-circle-left"></i>Réduire</button></p>
    </div>
    <div class="flex flex-column secondPart">
        <div class="navbar">
            <div class="flex align-items-center">
                <img src="https://images.unsplash.com/photo-1527980965255-d3b416303d12?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTgwOTN8MHwxfHNlYXJjaHw2fHxhdmF0YXJ8ZW58MHx8fHwxNjQ1NDQ1MjIx&ixlib=rb-1.2.1&q=80&w=1080" alt="Avatar">
                <h1>Bienvenue sur votre Dashboard</h1>
            </div>
            <div class="flex align-items-center gap-20">
                <a href="profile">
                    <p class="m-0">Jean Pierre<i class="fas fa-user"></i></p>
                </a>
                <button style="background: none; border: none">
                    <i class="far fa-moon"></i>
                </button>
                <button style="background: none; border: none">
                    <i class="fas fa-toggle-off"></i>
                </button>
            </div>
        </div>
        <div class="stats flex justify-content-between border-bottom-solid border-bottom-2 border-bottom-blue">
            <div class="flex gap-30">
                <div class="flex flex-column justify-content-end">
                    <div class="flex gap-7">
                        <strong class="m-0 data align-self-end">140</strong>
                        <p class="m-0 percentData--warning">-7,00%</p>
                    </div>
                    <small>nombres de vues</small>
                </div>
                <div class="flex flex-column justify-content-end">
                    <div class="flex gap-7">
                        <strong class="data m-0 align-self-end">140</strong>
                        <p class="m-0 percentData--success">+7,00%</p>
                    </div>
                    <small>nouveaux inscrits</small>
                </div>
                <div class="flex flex-column justify-content-end">
                    <div class="flex gap-7">
                        <strong class="data m-0 align-self-end">140</strong>
                        <p class="m-0 percentData--success">+7,00%</p>
                    </div>
                    <small>abonnés à la newsletter</small>
                </div>
            </div>
            <div class="align-self-end">
                <a class="voir-plus-button" href="">Voir plus</a>
            </div>
        </div>
        <div class="flex flex-column">
            <!-- <table class="bookingTableHeader" border="0" cellspacing="5" cellpadding="5">
                <tbody class="flex">
                    <tr>
                        <td>Réservations</td>
                        <td>Date :</td>
                        <td><input type="date" id="min" name="min" value="<?= date('Y-m-d'); ?>"></td>
                        <td>
                            <a class="align-self-end" href="#">Voir plus</a>
                        </td>
                    </tr>
                </tbody>
            </table> -->
            <section class="bookingTableHeader flex justify-content-between">
                <section class="flex">
                    <p class="align-self-end">Réservations</p>
                    <input class="align-self-end" type="date">
                </section>
                <section class="align-self-end">
                    <a href="#">Voir plus</a>
                </section>
            </section>
            <table id="bookingTable" class="display nowrap">
                <thead>
                    <tr>
                        <th>N° Réservation</th>
                        <th>Nom Prénom</th>
                        <th>Nombre de personnes</th>
                        <th>Heure</th>
                        <th>Table</th>
                        <th>Téléphone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>8888888</td>
                        <td>Jean Pierre Delasoul</td>
                        <td>4 personnes</td>
                        <td>21h45</td>
                        <td>45</td>
                        <td>07.69.69.69.45</td>
                        <td>Test</td>
                    </tr>
                    <tr>
                        <td>8888888</td>
                        <td>Jean Pierre Delasoul</td>
                        <td>4 personnes</td>
                        <td>21h45</td>
                        <td>45</td>
                        <td>07.69.69.69.45</td>
                        <td>Test</td>
                    </tr>
                    <tr>
                        <td>8888888</td>
                        <td>Jean Pierre Delasoul</td>
                        <td>4 personnes</td>
                        <td>21h45</td>
                        <td>45</td>
                        <td>07.69.69.69.45</td>
                        <td>Test</td>
                    </tr>
                    <tr>
                        <td>8888888</td>
                        <td>Jean Pierre Delasoul</td>
                        <td>4 personnes</td>
                        <td>21h45</td>
                        <td>45</td>
                        <td>07.69.69.69.45</td>
                        <td>Test</td>
                    </tr>
                    <tr>
                        <td>8888888</td>
                        <td>Jean Pierre Delasoul</td>
                        <td>4 personnes</td>
                        <td>21h45</td>
                        <td>45</td>
                        <td>07.69.69.69.45</td>
                        <td>Test</td>
                    </tr>
                    <tr>
                        <td>8888888</td>
                        <td>Jean Pierre Delasoul</td>
                        <td>4 personnes</td>
                        <td>21h45</td>
                        <td>45</td>
                        <td>07.69.69.69.45</td>
                        <td>Test</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <section class="container-preview-cards">

            <article class="card">
                <figure>
                    <img src="https://marketplace.canva.com/EAEPN913uPs/1/0/1131w/canva-vert-et-or-case-bordure-g%C3%A9om%C3%A9trique-floral-mariage-menu-DI7xnk_h_VU.jpg" alt="Benefit 3">
                </figure>
                <a class="cta-button--blue">Activé</a>
                <footer>
                    <h1>menu principal</h1>
                    <h2>pour Pizza Gogo</h2>
                </footer>
            </article>
            <article class="card">
                <figure>
                    <img src="https://marketplace.canva.com/EAEPN913uPs/1/0/1131w/canva-vert-et-or-case-bordure-g%C3%A9om%C3%A9trique-floral-mariage-menu-DI7xnk_h_VU.jpg" alt="Benefit 3">
                </figure>
                <a class="cta-button--blue">Activé</a>
                <footer>
                    <h1>menu principal</h1>
                    <h2>pour Pizza Gogo</h2>
                </footer>
            </article>
            <article class="card">
                <figure>
                    <img src="https://marketplace.canva.com/EAEPN913uPs/1/0/1131w/canva-vert-et-or-case-bordure-g%C3%A9om%C3%A9trique-floral-mariage-menu-DI7xnk_h_VU.jpg" alt="Benefit 3">
                </figure>
                <a class="cta-button--blue">Activé</a>
                <footer>
                    <h1>menu principal</h1>
                    <h2>pour Pizza Gogo</h2>
                </footer>
            </article>
            <article class="card">
                <figure>
                    <img src="https://marketplace.canva.com/EAEPN913uPs/1/0/1131w/canva-vert-et-or-case-bordure-g%C3%A9om%C3%A9trique-floral-mariage-menu-DI7xnk_h_VU.jpg" alt="Benefit 3">
                </figure>
                <a class="cta-button--blue">Activé</a>
                <footer>
                    <h1>menu principal</h1>
                    <h2>pour Pizza Gogo</h2>
                </footer>
            </article>
            <article class="card">
                <figure>
                    <img src="https://marketplace.canva.com/EAEPN913uPs/1/0/1131w/canva-vert-et-or-case-bordure-g%C3%A9om%C3%A9trique-floral-mariage-menu-DI7xnk_h_VU.jpg" alt="Benefit 3">
                </figure>
                <a class="cta-button--blue">Activé</a>
                <footer>
                    <h1>menu principal</h1>
                    <h2>pour Pizza Gogo</h2>
                </footer>
            </article>
            <article class="card">
                <figure>
                    <img src="https://marketplace.canva.com/EAEPN913uPs/1/0/1131w/canva-vert-et-or-case-bordure-g%C3%A9om%C3%A9trique-floral-mariage-menu-DI7xnk_h_VU.jpg" alt="Benefit 3">
                </figure>
                <a class="cta-button--blue">Activé</a>
                <footer>
                    <h1>menu principal</h1>
                    <h2>pour Pizza Gogo</h2>
                </footer>
            </article>
        </section>
    </div>
</div>


<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>