<main class="flex pageDashboard">
<?php $this->includePartial("themes-sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
        <?php $this->includePartial("topBar", ["title" => "Thèmes"]); ?>
        <section class="flex flex-row flex-wrap justify-content-center">
            <?php foreach ($themes as $theme) : ?>
                <div class="flex flex-column m-box  ">
                    <img class="rounded-t-md  w-full h-1-4" src="../public/src/screenshot<?php echo $theme->id ?>.png" alt="themes<?php echo $theme->id ?>">
                    <div class="flex flex-row align-items-center justify-content-between rounded-b-md w-full bg-grey">
                        <p class="ml-3"><?php echo $theme->name ?></p>
                        <button class="btn btn-submit text-white mr-3" style="background-color: <?php echo $_SESSION['theme']['id'] !== $theme->id ?: 'white' ?>;"><a href="themes/switchTheme?id=<?php echo $theme->id ?>"><?php echo $_SESSION['theme']['id'] !== $theme->id ? 'Activer' : 'Activé' ?></a></button>
                    </div>
                </div>
            <?php endforeach; ?>
            <!--Exemple -->
            <div class="flex flex-column m-box  ">
                <img class="rounded-t-md  w-full h-1-4" src="../public/src/screenshot3.png" alt="themes3">
                <div class="flex flex-row align-items-center justify-content-between rounded-b-md w-full bg-grey">
                    <p class="ml-3">Example1</p>
                    <button class="btn btn-submit text-white mr-3"><a href="#">Activer</a></button>
                </div>
            </div>
            <div class="flex flex-column m-box  ">
                <img class="rounded-t-md  w-full h-1-4" src="../public/src/screenshot4.png" alt="themes4">
                <div class="flex flex-row align-items-center justify-content-between rounded-b-md w-full bg-grey">
                    <p class="ml-3">Example2</p>
                    <button class="btn btn-submit text-white mr-3"><a href="#">Activer</a></button>
                </div>
            </div>
            <div class="flex flex-column m-box  ">
                <img class="rounded-t-md  w-full h-1-4" src="../public/src/screenshot5.png" alt="themes5">
                <div class="flex flex-row align-items-center justify-content-between rounded-b-md w-full bg-grey">
                    <p class="ml-3">Example3</p>
                    <button class="btn btn-submit text-white mr-3"><a href="#">Activer</a></button>
                </div>
            </div>
            <div class="flex flex-column m-box  ">
                <img class="rounded-t-md  w-full h-1-4" src="../public/src/screenshot5.png" alt="themes6">
                <div class="flex flex-row align-items-center justify-content-between rounded-b-md w-full bg-grey">
                    <p class="ml-3">Example4</p>
                    <button class="btn btn-submit text-white mr-3"><a href="#">Activer</a></button>
                </div>
            </div>
            <!-- -->
        </section>
    </section>
</main>