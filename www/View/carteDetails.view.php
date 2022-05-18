<form method="post" action="updateCarte">
    <input type="text" name="name" value="<?= $carte["name"] ?>"></input>
    <input type="checkbox" id="status" name="status" <?php if ($carte["status"] !== 0) : ?> checked="checked" <?php endif ?>>
    <label for="status">Status</label> 
    <input type="hidden" name="id_restaurant" value="1"></input>
    <input type="submit" value="Modifier"></input>
</form>