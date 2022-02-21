<!-- <h1>Bienvenue dans votre Dashboard</h1> -->
<!-- Welcome <?= $firstname ?> <?= $lastname ?> -->

<div class="flex pageDashboard">
    <div class="flex flex-column navbar justify-content-between align-items-stretch flex-wrap">
        <div class="flex flex-column align-items-center">
            <a href="dashboard">
                <img class="companyProfileImg" src="https://images.unsplash.com/photo-1554469384-e58fac16e23a?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTgwOTN8MHwxfHNlYXJjaHwzfHxidWlsZGluZ3xlbnwwfHx8fDE2NDUzODA4MTQ&ixlib=rb-1.2.1&q=80&w=1080" alt="Avatar">
                <h2>Nom Entreprise</h2>
            </a>
            <a href="profile"><button><i class="far fa-user-circle"></i>Profil</button></a>
            <a href="#"><button><i class="far fa-edit"></i>Thèmes</button></a>
            <a href="#"><button><i class="far fa-chart-bar"></i>Statistiques</button></a>
            <a href="#"><button><i class="far fa-lemon"></i>Restaurants</button></a>
            <a href="#"><button><i class="far fa-list-alt"></i>Utilisateurs</button></a>
        </div>
        <p class="align-self-end"><button id="navbarButton"><i class="far fa-arrow-alt-circle-left"></i>Réduire</button></p>
    </div>
    <div class="flex flex-column secondPart">
        <div class="flex justify-content-between topBar align-items-center">
            <div class="flex align-items-center">
                <img src="https://images.unsplash.com/photo-1527980965255-d3b416303d12?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTgwOTN8MHwxfHNlYXJjaHw2fHxhdmF0YXJ8ZW58MHx8fHwxNjQ1NDQ1MjIx&ixlib=rb-1.2.1&q=80&w=1080" alt="Avatar">
                <h1>Bienvenue sur votre Dashboard</h1>
            </div>
            <div id="profileDiv">
                <a href="profile">
                    <p>Jean Pierre<i class="fas fa-user"></i></p>
                </a>
                <button>
                    <i class="far fa-moon"></i>
                    <i class="fas fa-toggle-off"></i>
                </button>
            </div>
        </div>
        <div class="flex stats justify-content-between">
            <div class="flex">
                <div>
                    <p>140 +7%</p>
                    <small>nombres de vues</small>
                </div>
                <div>
                    <p>140 +7%</p>
                    <small>nouveaux inscrits</small>
                </div>
                <div>
                    <p>140 +7%</p>
                    <small>abonnés à la newsletter</small>
                </div>
            </div>
            <div class="align-self-end">
                <a href="">Voir plus</a>
            </div>
        </div>
    </div>
</div>