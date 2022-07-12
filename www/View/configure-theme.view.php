<main class="flex pageDashboard">
    <?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <secion class="flex flex-column secondPart">
        <?php $this->includePartial("topBar", ["title" => $theme['name']]); ?>
            <form class="flex flex-column" action="/themes/update/<?php echo $theme['id']; ?>" method="post">
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
</main>