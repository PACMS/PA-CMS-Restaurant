

<section class="sidebar">
        <nav class="sidebar-nav">
            <a href="/dashboard">
                <img class="sidebar-image" src="https://images.unsplash.com/photo-1554469384-e58fac16e23a?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTgwOTN8MHwxfHNlYXJjaHwzfHxidWlsZGluZ3xlbnwwfHx8fDE2NDUzODA4MTQ&ixlib=rb-1.2.1&q=80&w=1080" alt="Avatar">
                <h2 class="sidebar-title"><?php if(!empty($_SESSION["restaurant"]) && !empty($_SESSION["restaurant"]["name"])){
                    echo $_SESSION["restaurant"]["name"];
                }else{
                    echo $_SESSION["user"]["firstname"]. " " .$_SESSION["user"]["lastname"];
                } ?></h2>
            </a>
            <ul class="sidebar-list">
                <li><a href="/profile" class="sidebar-button<?php echo strpos($_SERVER['REQUEST_URI'], "/profile") === 0 ? '--active' : ''; ?>"><i class="far fa-user-circle sidebar-button-picto"></i><span>Profil</span></a></li>
                <?php if($_SESSION["user"]["role"] == "admin"): ?>
                <li><a href="/themes" class="sidebar-button<?php echo strpos($_SERVER['REQUEST_URI'], "/themes") === 0 ? '--active' : ''; ?>"><i class="far fa-edit sidebar-button-picto"></i><span>Thèmes</span></a></li>
                <?php endif; ?>
                <li><a href="/restaurants" class="sidebar-button<?php echo strpos($_SERVER['REQUEST_URI'], "/restaurant") === 0 ? '--active' : ''; ?>"><i class="far fa-lemon sidebar-button-picto"></i><span>Restaurants</span></a></li>
                <?php if($_SESSION["user"]["role"] == "admin"): ?>
                <li> <a href="/users" class="sidebar-button<?php echo strpos($_SERVER['REQUEST_URI'], "/user") === 0 ? '--active' : ''; ?>"><i class="far fa-list-alt sidebar-button-picto"></i><span>Utilisateurs</span></a></li>
                <li> <a href="/logs" class="sidebar-button<?php echo strpos($_SERVER['REQUEST_URI'], "/logs") === 0 ? '--active' : ''; ?>"><i class="far fa-list-alt sidebar-button-picto"></i><span>Logs</span></a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <button id="navbarButton" class="sidebar-resizer"><i class="far fa-arrow-alt-circle-left"></i></button>
    </section>