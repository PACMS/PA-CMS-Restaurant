<main class="flex pageDashboard">
    <?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
    <?php $this->includePartial("topBar", ["title" => "Créer une page"]); ?>
        <section class="formProfile flex flex-column">
            <div class="container justify-center items-center">
                <form method="POST" action="/restaurant/pagesave?id=<?php echo $id_restaurant ?>">
                    <div class="flex flex-row justify-content-between w-full">
                        <!-- Prenom -->
                        <div class="flex flex-column">
                            <label class="greytext " for="name">Nom de la page</label>
                            <input class="" id="name" name="name" type="text">

                            <label class="greytext mt-8 mb-8" for="title">Titre de la page</label>
                            <input class="" id="title" name="title" type="text">

                            <div>
                                <h4>Afficher le menu dans votre page ?</h4>
                                <input type="radio" id="menuYes" name="displayMenu" value="1" required="required">
                                <label for="menuYes">Oui</label>

                                <input type="radio" id="menuNo" name="displayMenu" value="0" required="required" checked="checked">
                                <label for="menuNo">Non</label>
                            </div>
                            <div>
                                <h4>Afficher les commentaires dans votre page ?</h4>
                                <input type="radio" id="commentYes" name="displayComment" value="1" required="required">
                                <label for="commentYes">Oui</label>

                                <input type="radio" id="commentNo" name="displayComment" value="0" required="required" checked="checked">
                                <label for="commentNo">Non</label>
                            </div>
                            <div class="mt-8" id="clone-row">

                            </div>
                            <label class="greytext mt-8" for="title">Appuier sur le Bouton pour le nombre de Section voulu</label>
                            <button type="button" id="addWysiwyg" class="flex justify-content-center bg-white border-none">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490.2 490.2" class=" w-12 mt-2 mb-2 " style="enable-background:new 0 0 490.2 490.2;" xml:space="preserve">

                                    <path d="M418.5,418.5c95.6-95.6,95.6-251.2,0-346.8s-251.2-95.6-346.8,0s-95.6,251.2,0,346.8S322.9,514.1,418.5,418.5z M89,89
                                        c86.1-86.1,226.1-86.1,312.2,0s86.1,226.1,0,312.2s-226.1,86.1-312.2,0S3,175.1,89,89z" />
                                    <path d="M245.1,336.9c3.4,0,6.4-1.4,8.7-3.6c2.2-2.2,3.6-5.3,3.6-8.7v-67.3h67.3c3.4,0,6.4-1.4,8.7-3.6c2.2-2.2,3.6-5.3,3.6-8.7
                                        c0-6.8-5.5-12.3-12.2-12.2h-67.3v-67.3c0-6.8-5.5-12.3-12.2-12.2c-6.8,0-12.3,5.5-12.2,12.2v67.3h-67.3c-6.8,0-12.3,5.5-12.2,12.2
                                        c0,6.8,5.5,12.3,12.2,12.2h67.3v67.3C232.8,331.4,238.3,336.9,245.1,336.9z" />
                                </svg>
                            </button>

                            <button type="submit">Envoyer</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </section>

</main>
<script type="text/javascript">
    var count = 0

    $("#addWysiwyg").on("click", function(event) {
        count++;
        var row = document.getElementById("clone-row");

        var column = document.createElement("div");
        row.appendChild(column);
        var label = document.createElement("label");
        label.setAttribute("class", "greytext mt-8 ");
        label.setAttribute("for", "editor1" + count);
        label.innerHTML += "Section " + count;

        column.appendChild(label);
        var textarea = document.createElement("textarea");
        textarea.setAttribute("id", "editor" + count);
        textarea.setAttribute("name", "body" + count);
        textarea.setAttribute("rows", 8);
        textarea.setAttribute("cols", 80);
        column.appendChild(textarea);

        tinymce.init({
            target: textarea,
            plugins: 'a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
            toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table tableofcontents',
            toolbar_mode: 'floating',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
        });
    });
</script>