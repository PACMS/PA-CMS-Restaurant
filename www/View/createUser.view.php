<main class="flex pageDashboard">
    <?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
        <div class="flex justify-content-between navbar align-items-center">
            <div id="profileDiv">
                <a href="#">
                    <p><?php echo $_SESSION['user']['firstname'] ?><i class="fas fa-user"></i></p>
                </a>
                <button>
                    <i class="far fa-moon"></i>
                    <i class="fas fa-toggle-off"></i>
                </button>
            </div>
        </div>
        <section class="usersTableHeader flex justify-content-between">
            <form action="saveUser" method="POST">
                <div class="flex justify-content-between">
                    <div class="flex flex-column">
                        <label for="firstname">Prénom</label>
                        <input type="text" name="firstname" id="firstname">
                    </div>
                    <div class="flex flex-column">
                        <label for="lastname">Nom</label>
                        <input type="text" name="lastname" id="lastname">
                    </div>
                </div>
                <div class="flex flex-column">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                </div>
                <div class="flex justify-content-between">
                    <div class="flex flex-column">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <div class="flex flex-column">
                        <label for="passwordConfirm">Confirmation</label>
                        <input type="password" name="passwordConfirm" id="passwordConfirm">
                    </div>
                </div>
                <div class="flex justify-content-between">
                    <div>
                        <label for="role">Rôle</label>
                        <select name="role" id="role">
                            <option value="admin">Administrateur</option>
                            <option value="user">Utilisateur</option>
                            <option value="employee">Employé</option>
                        </select>
                    </div>
                    <div>
                        <label for="status">Statut</label>
                        <select name="status" id="status">
                            <option value="1">Actif</option>
                            <option value="0">Inactif</option>
                        </select>
                    </div>
                </div>
                <div>
                    <input type="submit" value="Créer">
                </div>
            </form>
        </section>
    </section>
</main>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
