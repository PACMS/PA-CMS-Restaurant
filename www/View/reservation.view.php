<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.bundle.min.js"></script>

<main class="flex pageDashboard">
    <section class="sidebar">
        <nav class="sidebar-nav">
            <a href="dashboard">
                <img class="sidebar-image" src="https://images.unsplash.com/photo-1554469384-e58fac16e23a?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTgwOTN8MHwxfHNlYXJjaHwzfHxidWlsZGluZ3xlbnwwfHx8fDE2NDUzODA4MTQ&ixlib=rb-1.2.1&q=80&w=1080" alt="Avatar">
                <h2 class="sidebar-title">Nom Entreprise</h2>
            </a>
            <ul class="sidebar-list">
                <li><a href="profile" class="sidebar-button--active"><i class="far fa-user-circle sidebar-button-picto"></i><span>Profil</span></a></li>
                <li><a href="#" class="sidebar-button"><i class="far fa-edit sidebar-button-picto"></i><span>Thèmes</span></a></li>
                <li><a href="#" class="sidebar-button"><i class="far fa-chart-bar sidebar-button-picto"></i><span>Statistiques</span></a></li>
                <li><a href="#" class="sidebar-button"><i class="far fa-lemon sidebar-button-picto"></i><span>Restaurants</span></a></li>
                <li> <a href="#" class="sidebar-button"><i class="far fa-list-alt sidebar-button-picto"></i><span>Utilisateurs</span></a></li>
            </ul>
        </nav>
        <button id="navbarButton" class="sidebar-resizer"><i class="far fa-arrow-alt-circle-left"></i></button>
    </section>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
        <div class="flex justify-content-between navbar align-items-center">

            <h1>Reservation</h1>
            <div id="profileDiv">
                <a href="#">
                    <p>Jean Pierre<i class="fas fa-user"></i></p>
                </a>
                <button>
                    <i class="far fa-moon"></i>
                    <i class="fas fa-toggle-off"></i>
                </button>
            </div>
        </div>
        <section class="formProfile flex flex-column">
            <div id="open-modal" class="modal-window">
                <div>
                    <a href="#" title="Close" class="modal-close">Close</a>
                  <!--  <form method="post" action="addReservation">
                    <div class="containerForm">

                        <label for="name" class="greytext">Nom et prénom</label>
                        <input type="text" name="name"  autofocus>

                        <label for="numPerson" class="greytext">Nombre de personne</label>
                        <input type="number" name="numPerson"  >

                        <label for="numTable" class="greytext">Numero de table</label>
                        <input type="number" name="numTable"  >

                        <label for="date" class="greytext">Date de reservation</label>
                        <input type="date" min="<?php //echo $dateNow ?>" max="<?php //echo $futureDate ?>" name="date" >

                        <label for="phone" class="greytext">Numéro de téléphone</label>
                        <input type="tel" name="phone" >

                        <button id=""  type="submit" class="btn btn-submit mt-7  pr-20 pl-20">
                            Ajouter
                        </button>
                    </div>
                    </form>-->
                    <?php $this->includePartial("formReserv", $reservation->getModalForm()); ?>
                </div>
            </div>
            <a class='btn btn-submit pr-20 pl-20' href="#open-modal" id='btncancel'>Ajout de reservation</a>
            <section class="grid" style="margin-top: 35px;">
                <div class="row">
                    <div class="cols-lg-12 cols-md-12 cols-sm-12">
                        <div class="flex flex-column">

                            <section class="bookingTableHeader flex justify-content-between">

                            </section>
                            <table id="bookingTable2" class="display nowrap">
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
            </section>

        </section>
    </section>

</main>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
<script>
    $('#bookingTable2').dataTable( {
        columnDefs: [
            { className: "dt-center", targets: "_all" },
            { targets: -1, data: null, defaultContent: "<a href=''><i class='fas fa-pen'></i></a><a href=''><i class='fas fa-times-circle'></i></a>" },
        ],
        columns: [null, null, null, { type: "datetime" }, null, null, null],
        searching: true,
        paging: false,
        info: false,
    });
        // Refilter the table
        $("#min, #max").on("change", function () {
        table.draw();
    });

</script>