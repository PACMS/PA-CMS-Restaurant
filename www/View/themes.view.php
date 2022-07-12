<main class="flex pageDashboard">
    <?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
        <?php $this->includePartial("topBar", ["title" => "Thèmes"]); ?>
        <section class="flex flex-row flex-wrap justify-content-center">
            <?php foreach ($themes as $theme) : ?>
                <div class="flex flex-column m-box">
                    <a href="/themes/configure/<?php echo $theme->id; ?>"><img class="rounded-t-md themes-card w-full h-1-4" src="../public/src/screenshot<?php echo $theme->id ?>.png" alt="themes<?php echo $theme->id ?>"></a>
                    <div class="flex flex-row align-items-center justify-content-between rounded-b-md w-full bg-grey">
                        <p class="ml-3"><?php echo $theme->name ?></p>
                        <button class="btn btn-submit text-white mr-3"><a class="text-white" href="/themes/configure/<?php echo $theme->id; ?>">Configurer</a></button>
                        <button class="btn btn-submit text-white mr-3" style="background-color: <?php echo $_SESSION['theme']['id'] !== $theme->id ?: 'white' ?>;"><a href="themes/switchTheme?id=<?php echo $theme->id ?>"><?php echo $_SESSION['theme']['id'] !== $theme->id ? 'Activer' : 'Activé' ?></a></button>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    </section>
</main>