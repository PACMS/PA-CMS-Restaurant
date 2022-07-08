<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.bundle.min.js"></script>

<main class="flex pageDashboard">
    <?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
    <?php $this->includePartial("topBar", ["title" => "Pages"]); ?>
        <section class="formProfile flex flex-column">
            <a class='btn btn-submit pr-20 pl-20 w-48' href="/restaurant/pagecreate?id=<?php echo $idrestaurant ?>" id=''>Ajout d'une page</a>
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
                                        <th>Url</th>
                                        <th>Status</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($pages as $page) :
                                    ?>
                                        <tr>
                                            <td> <?php echo $page['id'] ?> </td>
                                            <td> <?php echo strtolower($page['url']) ?> </td>
                                            <td> <?php echo $page['status'] ?> </td>
                                            <td> <?php echo $page['created_at'] ?> </td>
                                            <td> <?php echo $page['updated_at'] ?> </td>
                                            <td>
                                                <a href='/page/show?id=<?php echo $page['id'] ?>'>
                                                    <i class='fas fa-pen'></i>
                                                </a>
                                                <a href='/page/delete?id=<?php echo $page['id'] ?>'>
                                                    <i class='fas fa-times-circle'></i>
                                                </a>
                                            </td>
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