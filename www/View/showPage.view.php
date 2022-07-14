<main class="flex pageDashboard">
    <?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
    <?php $this->includePartial("topBar", ["title" => "Modification de pages"]); ?>
        <section class="formProfile flex flex-column">
            <section class="grid" style="margin-top: 35px;">
                <div class="row">
                    <div class="cols-lg-12 cols-md-12 cols-sm-12">
                        <div class="flex flex-column">
                            <section class="bookingTableHeader ">
                                <form method="POST" action="/restaurant/page/edit?id=<?php echo $page['id'] ?>">
                                    <div class="flex flex-column justify-content-between w-full">

                                        <label class="greytext">Titre</label>
                                        <input class="w-48" type="text" name="title" value="<?php echo $page['title'] ?>">
                                        <div>
                                            <h4>Afficher le menu dans votre page ?</h4>
                                            <input type="radio" id="menuYes" name="displayMenu" value="1" required="required" <?= $page["display_menu"] == 1 ? 'checked="checked"' : "" ?>>
                                            <label for="menuYes">Oui</label>

                                            <input type="radio" id="menuNo" name="displayMenu" value="0" required="required" <?= $page["display_menu"] == 0 ? 'checked="checked"' : "" ?>>
                                            <label for="menuNo">Non</label>
                                        </div>
                                        <div>
                                            <h4>Afficher les commentaires dans votre page ?</h4>
                                            <input type="radio" id="commentYes" name="displayComment" value="1" required="required" <?= $page["display_comments"] == 1 ? 'checked="checked"' : "" ?>>
                                            <label for="commentYes">Oui</label>

                                            <input type="radio" id="commentNo" name="displayComment" value="0" required="required" <?= $page["display_comments"] == 0 ? 'checked="checked"' : "" ?>>
                                            <label for="commentNo">Non</label>
                                        </div>
                                        <div>
                                            <h4>Afficher les champs réservations dans votre page ?</h4>
                                            <input type="radio" id="reservationYes" name="displayReservation" value="1" required="required" <?= $page["display_reservations"] == 1 ? 'checked="checked"' : "" ?>>
                                            <label for="reservationYes">Oui</label>

                                            <input type="radio" id="reservationNo" name="displayReservation" value="0" required="required" <?= $page["display_reservations"] == 0 ? 'checked="checked"' : "" ?>>
                                            <label for="reservationNo">Non</label>
                                        </div>
                                        <?php foreach ($contents as $content) { ?>

                                            <label class="greytext mt-7 "><?php echo 'Section' ?></label>
                                            <textarea name="body<?php echo $content['id'] ?>">
                                                  <?php echo $content['body'] ?>
                                            </textarea>

                                        <?php } ?>
                                        <button class="w-48 mt-7" type="submit">Modifier</button>
                                    </div>
                                </form>
                            </section>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>
</main>

<script type="text/javascript">
    tinymce.init({
        selector: 'textarea',
        plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
    });
</script>