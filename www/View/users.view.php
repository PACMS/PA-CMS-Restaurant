<main class="flex pageDashboard">
    <?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
        <div class="flex justify-content-between navbar align-items-center">
            <h1>Utilisateurs</h1>
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
            <table id="usersTable" class="display nowrap">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Email</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Status</th>
                        <th>Rôle</th>
                        <th>Date de création</th>
                        <th>Date de modification</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($users as $user) :
                        ?>
                        <tr>
                            <td> <?php echo $user->id ?> </td>
                            <td> <?php echo $user->email ?> </td>
                            <td> <?php echo $user->firstname ?> </td>
                            <td> <?php echo $user->lastname ?> </td>
                            <td> <?php echo $user->status == 1 ? 'actif' : 'non actif' ?> </td>
                            <td> <?php echo $user->role ?> </td>
                            <td> <?php echo $user->createdAt ?> </td>
                            <td> <?php echo $user->updatedAt ?> </td>
                            <td></td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </section>
        <button><a href="user/create">Ajouter un utilisateur</a></button>
    </section>
</main>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
