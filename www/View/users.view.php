<main class="flex pageDashboard">
    <?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
        <?php $this->includePartial("topBar", ["title" => "Utilisateurs"]); ?>
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
                            <td> 
                            <?php if ($_SESSION["user"]["id"] != $user->id): ?>
                                <button id='updateUser'><i class='fas fa-pen'></i></button>
                                <button id='deleteUser'><i class='fas fa-times-circle'></i></button>
                            <?php endif; ?> 
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </section>
        <button class="button"><a class="text-white" href="user/create">Ajouter un utilisateur</a></button>
    </section>
</main>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>