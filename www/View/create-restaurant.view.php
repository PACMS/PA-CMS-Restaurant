<?php
if (isset($errors)) :
    foreach ($errors as $error) :
        echo $error;
        echo '<br>';
    endforeach;
endif;
?>
<main class="flex pageDashboard">
<?php $this->includePartial("restaurants-sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
        <section class="navbar">
            <div class="flex align-items-center">
                <!-- <img src="https://images.unsplash.com/photo-1527980965255-d3b416303d12?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTgwOTN8MHwxfHNlYXJjaHw2fHxhdmF0YXJ8ZW58MHx8fHwxNjQ1NDQ1MjIx&ixlib=rb-1.2.1&q=80&w=1080" alt="Avatar"> -->
                <h1>Ajout d'un restaurant</h1>
            </div>
            <article class="flex align-items-center gap-20">
                <a href="/profile">
                    <p class="m-0"><i class="fas fa-user"></i></p>
                </a>
                <button style="background: none; border: none">
                    <i class="far fa-moon"></i>
                </button>
                <button style="background: none; border: none">
                    <i class="fas fa-toggle-off"></i>
                </button>
            </article>
        </section>
        <?php $this->includePartial("form", $restaurant->getCompleteRestaurantForm()); ?>
    </section>
</main>

<script>
    const submit = document.querySelector("input[type='submit']");
    submit.setAttribute("class", "cta-button");
</script>