<?php

use App\Core\MysqlBuilder;

$builder = new MysqlBuilder();
$currentRestaurant = $builder->select("page", ["id_restaurant"])
                        ->where("url", substr($_SERVER["REQUEST_URI"], 1))
                        ->fetchClass("page")
                        ->fetch();

$pages = $builder->select("page p", ["*"])
    ->rightJoin('restaurant r', "r.id", "p.id_restaurant")
    ->where("id_restaurant", $currentRestaurant->getIdRestaurant())
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