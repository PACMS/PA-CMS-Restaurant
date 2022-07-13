<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.bundle.min.js"></script>

<main class="flex pageDashboard">
    <?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
        <?php $this->includePartial("topBar", ["title" => "Logs"]); ?>
        <section class="formProfile flex flex-column">
            <?php if($_SESSION["user"]["role"] == "admin"): ?>
            <?php endif; ?>
            <section class="grid" style="margin-top: 35px;">
                <div class="row">
                    <div class="cols-lg-12 cols-md-12 cols-sm-12">
                        <div class="flex flex-column">
                            <section class="bookingTableHeader flex justify-content-between">

                            </section>
                            <table id="pageTable" class="display nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Etat</th>
                                    <th>Created_at</th>
                                </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>test </td>
                                        <!-- modifier le port dans le href si la page affiche rien -->
                                        <td> test </td>
                                        <td> test </td>
                                        <td> test </td>
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
