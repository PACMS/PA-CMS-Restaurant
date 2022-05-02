<?php
    if (isset($errors)):
        foreach ($errors as $error):
            echo $error;
            echo '<br>';
        endforeach;
    endif;
?>

    <h1>Restaurant <?= $_GET['id'] ?></h1>

    <form action="restaurant/delete" method="POST">
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
        <button type="submit">DELETE</button>
    </form><?= $restaurant["id"] ?>
    <form action="restaurant/create" method="POST">
    <input type="hidden" name="id" value="<?= $restaurant["id"] ?>">
<input id="name" name="name" placeholder="<?= $restaurant["name"]?>"></input>
<input id="address" name="address" placeholder="<?= $restaurant["address"]?>"></input>
<input id="additional_address" name="additional_address" placeholder="<?= $restaurant["additional_address"]?>"></input>
<input id="city" name="city" placeholder="<?= $restaurant["city"]?>"></input>
<input id="zipcode" name="zipcode" placeholder="<?= $restaurant["zipcode"]?>"></input>
<input id="phone" name="phone" placeholder="<?= $restaurant["phone"]?>"></input>
<button type="submit">MODIFIER LE RESTAURANT ZEBI</button>
</form>