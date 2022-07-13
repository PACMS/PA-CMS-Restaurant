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

                            <table id="logTable" class="display nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Utilisateur</th>
                                    <th>Email</th>
                                    <th>Etat</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($logs as $log) :
                                ?>
                                    <tr>
                                        <td> <?php echo $log->id ?> </td>
                                        <td> <?php echo $log->firstname ?> <?php echo $log->lastname ?> </td>
                                        <td> <?php echo $log->email ?> </td>
                                        <td> <?php echo $log->state ?> </td>
                                        <td> <?php echo $log->created_at ?> </td>
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