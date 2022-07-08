<section>
    <div>
        <h1>Titre du restaurant</h1>
        <p>Phrase d'accroche</p>
        <button>Voir nos menus</button>
    </div>
    <div>
        <img src="" alt="presentation">
    </div>
</section>

<section>
    <div>
        <img src="" alt="image story">
    </div>
    <div>
        <h3>Text de presentation</h3>
        <textarea name="" id="" cols="30" rows="10">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aliquid amet asperiores aut beatae dicta inventore iste, iure laudantium, maiores minima nihil numquam porro quaerat quo quos, tempore voluptates voluptatum.
        </textarea>
        <button>En savoir plus</button>
    </div>
</section>

<section>
    <div>
        <img src="" alt="presentation">
    </div>

    <div>
        <img src="" alt="presentation">
    </div>

    <div>
        <img src="" alt="presentation">
    </div>

    <div>
       <p>Horaire d'ouverture</p>
       <p>Horaire d'ouverture</p>
       <p>Horaire d'ouverture</p>
       <p>Horaire d'ouverture</p>
    </div>

    <div>
        <img src="" alt="presentation">
    </div>

    <div>
        <img src="" alt="presentation">
    </div>
</section>

<section>
    <h3>Faire une réservation</h3>
    <p>Date picker.......</p>
</section>

<section>
    <h3>Nous contacter</h3>
    <form action="">
        <input type="text" placeholder="Nom">
        <input type="text" placeholder="Nom">
        <input type="text" placeholder="Nom">
    </form>
</section>

<section>
    <h2>Ou sommes-nous ?</h2>
    <p>Carte...</p>
</section>

<script>
    tinymce.init({
        selector: 'textarea',
        placeholder: 'Description de votre restaurant',
        plugins: 'a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
        toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table tableofcontents',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
    });
</script>