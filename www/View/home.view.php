<div class="topnav">
    <?php if (!empty($_SESSION['user'])) : ?>
    <li class="right"><a href="/logout">Déconnexion</a></li>
    <?php else : ?>
    <li class="right"><a href="/login">Connexion</a></li>
    <?php endif; ?>
</div>
<main>
    <h1>Bienvenue</h1>

        
    <?php if (empty($pages)) : ?>
        <h3>Aucun restaurant n'est encore disponible !</h3>
    <?php elseif (!empty($pages)) : ?>
        <h3>Voici la liste des restaurants disponibles :</h3>
        <ul>
            <?php foreach ($pages as $page) : ?>
                <li><a href="/<?= $page->getUrl() ?>"><?= $page->name ?> (<?= $page->getTitle() ?>)</a></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</main>