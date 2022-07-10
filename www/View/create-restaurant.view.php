<?php
if (isset($errors)) :
    foreach ($errors as $error) :
        echo $error;
        echo '<br>';
    endforeach;
endif;
?>
<main class="flex pageDashboard">
    <?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
    <?php $this->includePartial("topBar", ["title" => "Création d'un restaurant"]); ?>
        <?php $this->includePartial("form", $restaurant->getCompleteRestaurantForm()); ?>
    </section>
</main>

<script>
    const submit = document.querySelector("input[type='submit']");
    submit.setAttribute("class", "cta-button");
</script>