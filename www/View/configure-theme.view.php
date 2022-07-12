<main class="flex pageDashboard">
    <?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <secion class="flex flex-column secondPart">
        <?php $this->includePartial("topBar", ["title" => $theme['name']]); ?>
        <section class="flex flex-column">
            <button class="button"><a class="text-white" href="/themes">Retour</a></button>
            <?php if ($pageUrl) : ?>
            <button class="button"><a class="text-white" href="/<?php echo $pageUrl; ?>">Voir la vue Administrateur</a></button>
            <?php endif; ?>
                <form class="flex flex-column mr-8" action="/themes/update/<?php echo $theme['id']; ?>" method="post">
                    <label for="">Choix de la police : </label>
                    <select name="font" id="">
                        <option value="<?php echo $theme['font']; ?>"><?php echo $theme['font']; ?></option>
                        <?php foreach ($fonts as $font) : ?>
                        <option value="<?php echo $font['family']; ?>"><?php echo $font['family']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="">Couleur h1 : </label>
                    <input type="color" name="h1" value="<?php echo $theme['h1']; ?>">
                    <label for="">Couleur h2 : </label>
                    <input type="color" name="h2" value="<?php echo $theme['h2']; ?>">
                    <label for="">Couleur h3 : </label>
                    <input type="color" name="h3" value="<?php echo $theme['h3']; ?>">
                    <label for="">Couleur p : </label>
                    <input type="color" name="p" value="<?php echo $theme['p']; ?>">
                    <input type="submit" value="Modifier">
                </form>
        </section>
    </section>
</main>