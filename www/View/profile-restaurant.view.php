<?php
    if (isset($errors)):
        foreach ($errors as $error):
            echo $error;
            echo '<br>';
        endforeach;
    endif;
?>

    <h1>Ajout d'un restaurant</h1>

<?php $this->includePartial("form", $restaurant->getCompleteRestaurantForm()); ?>
