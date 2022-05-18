<?php
if (isset($errors)) :
    foreach ($errors as $error) :
        echo $error;
        echo '<br>';
    endforeach;
endif;
?>
<h1>Restaurant <?= $_SESSION["id_restaurant"] ?></h1>

<form action="restaurant/delete" method="POST">
    <input type="hidden" name="id" value="<?= $_SESSION["id_restaurant"] ?>">
    <button type="submit">DELETE</button>
</form><?= $_SESSION["id_restaurant"] ?>
<a href="/cartes">Cartes</a>

<?php $this->includePartial("form", $restaurant->getCompleteRestaurantForm()); ?>