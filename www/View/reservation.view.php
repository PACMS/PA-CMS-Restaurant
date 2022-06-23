<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.bundle.min.js"></script>

<main class="flex pageDashboard">
<?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
        <div class="flex justify-content-between navbar align-items-center">
            <h1>Reservation</h1>
            <div id="profileDiv">
                <a href="#">
                    <p><?php echo $_SESSION['user']['firstname'] ?><i class="fas fa-user"></i></p>
                </a>
                <button>
                    <i class="far fa-moon"></i>
                    <i class="fas fa-toggle-off"></i>
                </button>
            </div>
        </div>
        <section class="formProfile flex flex-column">
            <div id="open-modal" class="modal-window">
                <div class="flex flex-column">
                    <a href="#" title="Close" class="modal-close ">x</a>
                    <?php $this->includePartial("formReserv", $reservation->getModalForm()); ?>
                </div>
            </div>
            <a class='btn btn-submit pr-20 pl-20 w-48' href="#open-modal" id='btncancel'>Ajout de reservation</a>
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
                                    <th>Date de reservation</th>
                                    <th>Heure</th>
                                    <th>Table</th>
                                    <th>Téléphone</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach ($data as $reservation) :
                                ?>
                                   <tr>
                                       <td> <?php echo $reservation->id ?> </td>
                                       <td> <?php echo $reservation->name ?> </td>
                                       <td> <?php echo $reservation->numPerson ?> </td>
                                       <td> <?php echo $reservation->date ?> </td>
                                       <td> <?php echo $reservation->hour ?> </td>
                                       <td> <?php echo $reservation->numTable ?> </td>
                                       <td> <?php echo $reservation->phoneReserv ?> </td>
                                       <td></td>
                                   </tr>
                                <?php
                                    endforeach;
                                ?>
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
