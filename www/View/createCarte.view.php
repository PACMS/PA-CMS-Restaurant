

<section id="editCard">
    <?php $this->includePartial("form", $carte->getCreateForm()); ?>
</section>

<script defer>

    $(`input[type='checkbox'], label[for='status']`).wrapAll("<div></div>");

</script>