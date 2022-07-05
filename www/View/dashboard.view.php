<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.bundle.min.js"></script>
<main class="flex pageDashboard">
<?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
        <?php $this->includePartial("topBar"); ?>
        <section class="stats flex justify-content-between border-bottom-solid border-bottom-2 border-bottom-blue">
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
        </section>
        <section class="grid" style="margin-top: 35px;">
            <div class="row">
                <div class="cols-lg-12 cols-md-12 cols-sm-12">
                    <div class="flex flex-column">

                        <section class="bookingTableHeader flex justify-content-between">
                            <section class="flex">
                                <p class="align-self-end">Réservations</p>
                                <input class="calendar" type="date">
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
                </div>

            </div>
            <div class="row" style="justify-content: space-between">

                <div class="cols-lg-6 cols-md-12 cols-sm-12 offset-sm-3" style="width: 47.5%">
                    <section class="bookingTableHeader flex justify-content-between align-items-center">
                        <p>Cartes</p>

                        <a href="#">Voir plus</a>

                    </section>
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

                <div class="cols-lg-6 cols-md-12 cols-sm-12 offset-sm-3" style="width: 47.5%">
                    <div>
                        <section class="bookingTableHeader flex justify-content-between align-items-center">
                            <p>Dépenses</p>

                            <a href="#">Voir plus</a>

                        </section>

                        <article class="container_dashboard">
                            <figure>
                                <img src="../public/src/graphPicture.png" alt="graph" />
                            </figure>
                            <div>
                                <p>Dépenses annuelles</p>
                                <strong class="data m-0 ">36000€</strong>
                                <p class="m-0 percentData--success">+7,00%</p>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>

    </section>
</main>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
