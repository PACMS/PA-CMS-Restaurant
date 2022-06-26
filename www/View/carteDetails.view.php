<section id="editCard">
    <?php $this->includePartial("form", $carteCtrl->getUpdateForm($carte)); ?>
    <?php $this->includePartial("form", $carteCtrl->getDeleteForm($carte->getId())); ?>
</section>

<script defer>

    $(`input[type='checkbox'], label[for='status']`).wrapAll("<div></div>");

</script>