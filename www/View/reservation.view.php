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
                    <?php $this->includePartial("form", $reservation->getModalForm()); ?>
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
                                    <th>Envoyer un mail</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach ($data as $reservationInfo) :
                                ?>
                                    <div id="open-modalEdit<?php echo $reservation['id'] ?>" class="modal-window">
                                        <div class="flex flex-column">
                                            <a href="#" title="Close" class="modal-close ">x</a>
                                            <form method="POST" action="/restaurant/editReservation?id=<?php echo $reservation['id']?>">
                                                <label class="greytext" for="name">Nom et prénom</label>
                                                <input class="mb-7" id="name" name="name" value="<?php echo $reservation['name'] ?>" type="text">

                                                <label class="greytext" for="numPerson">Nombre de personne</label>
                                                <input class="mb-7" id="numPerson" name="numPerson" value="<?php echo intval($reservation['numPerson']) ?>" type="number" >

                                                <label class="greytext" for="numTable">Numero de table</label>
                                                <input class="mb-7" id="numTable" name="numTable" value="<?php echo $reservation['numTable'] ?>" type="number" >

                                                <label class="greytext" for="date">Date de reservation</label>
                                                <input class="mb-7" id="date" name="date" value="<?php echo $reservation['date']?>" type="date">

                                                <label class="greytext" for="hour"">Heure de reservation</label>
                                                <input class="mb-7" id="hour" name="hour"  value="<?php echo $reservation['hour']?>" type="time">

                                                <label class="greytext" for="phoneReserv">Numéro de téléphone</label>
                                                <input class="mb-7" id="phoneReserv" name="phoneReserv"  value="<?php echo $reservation['phoneReserv'] ?>" type="number">

                                                <input type="submit" value="Modifier">
                                            </form>
                                        </div>
                                    </div>
                                   <tr>
                                       <td> <?php echo $reservationInfo->id ?> </td>
                                       <td> <?php echo $reservationInfo->name ?> </td>
                                       <td> <?php echo $reservationInfo->numPerson ?> </td>
                                       <td> <?php echo $reservationInfo->date ?> </td>
                                       <td> <?php echo $reservationInfo->hour ?> </td>
                                       <td> <?php echo $reservationInfo->numTable ?> </td>
                                       <td> <?php echo $reservationInfo->phoneReserv ?> </td>
                                       <td>
                                           <a href="#open-modalEdit<?php echo $reservation['id'] ?>" id='btncancel'>
                                               <i class='fas fa-pen'></i>
                                           </a>
                                           <a href='/restaurant/deleteReservation?id=<?php echo $reservation['id']?>'>
                                               <i class='fas fa-times-circle'></i>
                                           </a>
                                       </td>
                                       <td> <?php $this->includePartial("form", $reservation->EndForMailReservation(intval($reservationInfo->id))); ?> </td>
                                       
                                      
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
