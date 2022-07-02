<?php 
$step = empty($_GET['step']) ? 0 : $_GET['step'];
switch($step) {
    case 0:
?>
<h1>Bienvenue sur l'assistant</h1>
<button><a href="/setup?step=1">Next</a></button>
<?php
    break;
    case 1:
    echo $_GET['error'] ?? (!empty($_GET['error']));
?>
<form action="/setupAction" method="post" class="flex flex-column">
    <label for="db_driver">Nom du pilote de la base de données</label>
    <input type="text" name="driver" id="db_driver" value="mysql">
    <label for="db_name">Nom de la base de données</label>
    <input type="text" name="name" id="db_name" value="pacms_restaurant">
    <label for="db_user">Utilisateur de la base de données</label>
    <input type="text" name="user" id="db_user" value="root">
    <label for="db_password">Mot de passe de la base de données</label>
    <input type="password" name="password" id="db_password">
    <label for="db_host">Adresse de la base de données</label>
    <input type="text" name="host" id="db_host" value="localhost">
    <label for="db_port">Port de la base de données</label>
    <input type="text" name="port" id="db_port" value="3306">
    <label for="db_prefixe">Préfixe de la base de données</label>
    <input type="text" name="prefixe" id="db_prefixe" value="_pacm">
    <input type="submit" value="Envoyer">
</form>
<?php
    break;
    case 3:
?>
<h2>Test</h2>
<?php
    break;
}