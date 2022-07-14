<?php

use App\Core\MysqlBuilder;

$builder = new MysqlBuilder();
$pages = $builder->select("page p", ["*"])
    ->rightJoin('restaurant r', "r.id", "p.id_restaurant")
    ->fetchClass("page")
    ->fetchAll();
?>

<div class="topnav">
    <ul>

        <?php foreach ($pages as $page) : ?>
            <li><a href="/<?= $page->getUrl() ?>"><?= $page->getTitle() ?></a></li>
        <?php endforeach; ?>
    </ul>
    <?php if (!empty($_SESSION["user"])) : ?>
        <div>
            <a href="/logout">Déconnexion</a>
        </div>
    <?php else : ?>
        <div>
            <a href="/login">Connexion</a>
        </div>
    <?php endif; ?>

</div>