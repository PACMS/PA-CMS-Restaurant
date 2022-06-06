<main class="flex pageDashboard">
    <section class="sidebar">
        <nav class="sidebar-nav">
            <a href="dashboard">
                <img class="sidebar-image" src="https://images.unsplash.com/photo-1554469384-e58fac16e23a?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTgwOTN8MHwxfHNlYXJjaHwzfHxidWlsZGluZ3xlbnwwfHx8fDE2NDUzODA4MTQ&ixlib=rb-1.2.1&q=80&w=1080" alt="Avatar">
                <h2 class="sidebar-title">Nom Entreprise</h2>
            </a>
            <ul class="sidebar-list">
                <li><a href="profile" class="sidebar-button"><i class="far fa-user-circle sidebar-button-picto"></i><span>Profil</span></a></li>
                <li><a href="/themes" class="sidebar-button"><i class="far fa-edit sidebar-button-picto"></i><span>Thèmes</span></a></li>
                <li><a href="#" class="sidebar-button"><i class="far fa-chart-bar sidebar-button-picto"></i><span>Statistiques</span></a></li>
                <li><a href="/restaurants" class="sidebar-button"><i class="far fa-lemon sidebar-button-picto"></i><span>Restaurants</span></a></li>
                <li> <a href="#" class="sidebar-button"><i class="far fa-list-alt sidebar-button-picto"></i><span>Utilisateurs</span></a></li>
            </ul>
        </nav>
        <button id="navbarButton" class="sidebar-resizer"><i class="far fa-arrow-alt-circle-left"></i></button>
    </section>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
        <?php $this->includePartial("topBar", ["title" => "Thèmes"]); ?>
        <section class="flex flex-row flex-wrap justify-content-center">
            <?php foreach($themes as $theme) : ?>
                <div class="flex flex-column m-box  ">
                    <img class="rounded-t-md  w-full h-1-4" src="../public/src/screenshot<?php echo $theme->id ?>.png" alt="themes<?php echo $theme->id ?>">
                    <div class="flex flex-row align-items-center justify-content-between rounded-b-md w-full bg-grey">
                        <p class="ml-3"><?php echo $theme->name ?></p>
                        <button class="btn btn-submit text-white mr-3" style="background-color: <?php echo $_SESSION['theme']['id'] !== $theme->id ?: 'white' ?>;"><a href="themes/switchTheme?id=<?php echo $theme->id ?>"><?php echo $_SESSION['theme']['id'] !== $theme->id ?'Activer' : 'Activé' ?></a></button>
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