<main class="flex pageDashboard">
    <?php $this->includePartial("users-sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
        <div class="flex justify-content-between navbar align-items-center">
            <h1><?php echo $userInfos['email'] ?></h1>
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
            <form action="/user/save" method="POST">
                <div class="flex justify-content-between">
                    <div class="flex flex-column">
                        <label for="firstname">Prénom</label>
                        <input type="text" name="firstname" id="firstname" value="<?php echo $userInfos['firstname']?>">
                    </div>
                    <div class="flex flex-column">
                        <label for="lastname">Nom</label>
                        <input type="text" name="lastname" id="lastname" value="<?php echo $userInfos['lastname']?>">
                    </div>
                </div>
                <div class="flex justify-content-between">
                    <div class="flex flex-column">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo $userInfos['email']?>">
                    </div>
                </div>
                <div class="flex justify-content-between">
                    <div>
                        <label for="role">Rôle</label>
                        <select name="role" id="role">
                            <option value="admin" <?php echo $userInfos['role'] == 'admin' ? 'selected' : ''?>>Administrateur</option>
                            <option value="user" <?php echo $userInfos['role'] == 'user' ? 'selected' : ''?>>Utilisateur</option>
                            <option value="employee" <?php echo $userInfos['role'] == 'employee' ? 'selected' : ''?>>Employé</option>
                        </select>
                    </div>
                    <div>
                        <label for="status">Statut</label>
                        <select name="status" id="status">
                            <option value="1" <?php echo $userInfos['status'] == '1' ? 'selected' : '' ?>>Actif</option>
                            <option value="0" <?php echo $userInfos['status'] == '0' ? 'selected' : '' ?>>Inactif</option>
                        </select>
                    </div>
                </div>
                <div>
                    <input name="id" type="hidden" value="<?php echo $userInfos['id'] ?>">
                    <input type="submit" value="Mettre à jour">
                </div>
            </form>
        </section>
    </section>
</main>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
