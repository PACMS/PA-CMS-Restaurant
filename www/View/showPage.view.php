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
        plugins: 'a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
        toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table tableofcontents',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
    });
</script>