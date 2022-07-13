<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.bundle.min.js"></script>
<main class="flex pageDashboard">
    <?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
        <?php $this->includePartial("topBar"); ?>

        <?php if (!empty($_SESSION["favoriteRestaurant"])) : ?>
            <?php if (!empty($restaurant)) : ?>
                <h3 style="text-align: center">Voir restaurant favori : <?= $restaurant->getName() ?></h3>
            <?php endif; ?>
            <section class="grid">
                <div class="row">
                    <div class="cols-lg-12 cols-md-12 cols-sm-12">
                        <div class="flex flex-column">

                            <section class="bookingTableHeader flex justify-content-between">


                            </section>
                            <table id="bookingTable3" class="display nowrap">
                                <thead>
                                    <tr>
                                        <th>N° Réservation</th>
                                        <th>Nom Prénom</th>
                                        <th>Nombre de personnes</th>
                                        <th>Date de reservation</th>
                                        <th>Heure</th>
                                        <th>Table</th>
                                        <th>Téléphone</th>
                                        <th>Envoyer un mail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($reservations as $reservation) :
                                    ?>

                                        <tr>
                                            <td> <?= $reservation->getId() ?> </td>
                                            <td> <?= $reservation->getName() ?> </td>
                                            <td> <?= $reservation->getNumPerson() ?> </td>
                                            <td> <?= $reservation->getDate() ?> </td>
                                            <td> <?= $reservation->getHour() ?> </td>
                                            <td> <?= $reservation->getNumTable() ?> </td>
                                            <td> <?= $reservation->getPhoneReserv() ?> </td>

                                            <td> <?php $this->includePartial("form", $reservation->EndForMailReservation(intval($reservation->getId()))); ?> </td>


                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="row" style="justify-content: space-between">

                    <div class="cols-lg-6 cols-md-12 cols-sm-12 offset-sm-3" style="width: 47.5%">
                        <section class="bookingTableHeader flex justify-content-between align-items-center">
                            <p>Cartes</p>

                            <a href="/restaurant/cartes">Voir plus</a>

                        </section>
                        <section class="container-preview-cards">
                            <?php if (empty($cartes)) : ?>
                                <p>Aucune carte</p>
                            <?php else : ?>

                                <?php foreach ($cartes as $carte) : ?>
                                    <article class="card">
                                        <figure>
                                            <img src="https://marketplace.canva.com/EAEPN913uPs/1/0/1131w/canva-vert-et-or-case-bordure-g%C3%A9om%C3%A9trique-floral-mariage-menu-DI7xnk_h_VU.jpg" alt="Benefit 3">
                                            <footer>
                                                <?php if ($carte->getStatus() == 1) : ?>
                                                    <a class="cta-button--blue">Activé</a>
                                                <?php endif; ?>
                                                <h1><?= $carte->getName() ?></h1>
                                                <h2>Pour <?= $restaurant->getName() ?></h2>
                                            </footer>
                                        </figure>
                                    </article>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </section>
                    </div>



                    <div class="cols-lg-6 cols-md-12 cols-sm-12 offset-sm-3" style="width: 47.5%">
                        <div>
                            <p>Nombre de réservations par jour pour les 15 prochaines jours</p>
                            <div class="chart" id="chartdiv"></div>
                        </div>
                    </div>
                </div>
            </section>

    </section>

<?php else : ?>
    <p>Vous n'avez aucun restaurant favori</p></br>
    <a style="text-decoration: underline" href="/restaurants">Voir la liste des restaurants</a>
<?php endif; ?>

</main>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<script>
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("chartdiv", am4charts.XYChart);

        var reservations = <?php echo json_encode($stats) ?>;
        chart.data = [];

        for (let i = 0; i < 15; i++) {
            const date = new Date()
            date.setDate(date.getDate() + i)
            const day = date.getDate()
            const month = date.getMonth()
            const year = date.getFullYear()
            const dateTime = {
                date: new Date(year, month, day),
                value: reservations[i]
            }
            // console.log(dateTime)
            chart.data.push(dateTime)
        }

        // Add data

        // Create axes
        var dateAxis = chart.xAxes.push(new am4charts.DateAxis());

        // Create value axis
        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

        // Create series
        var lineSeries = chart.series.push(new am4charts.LineSeries());
        lineSeries.dataFields.valueY = "value";
        lineSeries.dataFields.dateX = "date";
        lineSeries.name = "Sales";
        lineSeries.strokeWidth = 3;





    }); // end am4core.ready()
</script>