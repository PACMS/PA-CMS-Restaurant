<?php
if (isset($errors)) :
    foreach ($errors as $error) :
        echo $error;
        echo '<br>';
    endforeach;
endif;
?>

<h1>Restaurant <?= $_GET['id'] ?></h1>

<form action="restaurant/delete" method="POST">
    <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
    <button type="submit">DELETE</button>
</form><?= $oneRestaurant["id"] ?>


<?php $this->includePartial("form", $restaurant->getCompleteRestaurantForm()); ?>