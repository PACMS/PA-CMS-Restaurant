<?php if (isset($config["title"])) : ?>
    <div class="flex justify-content-between navbar align-items-center">
        <div class="flex align-items-center">
            <h1><?php echo $config["title"] ?></h1>
        </div>
        <div id="profileDiv">
            <a href="/profile">
                <p><?php echo $_SESSION['user']['firstname'] ?><i class="fas fa-user"></i></p>
            </a>
            <button>
                <i class="far fa-moon"></i>
                <i class="fas fa-toggle-off"></i>
            </button>
            <button class="buttonsIcon">
                <a href="/logout"><i class="fas fa-sign-out-alt"></i></a>
            </button>
        </div>
    </div>
<?php else : ?>
    <section class="navbar">
        <div class="flex align-items-center">
            <a href="/profile">
                <img src="https://images.unsplash.com/photo-1527980965255-d3b416303d12?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTgwOTN8MHwxfHNlYXJjaHw2fHxhdmF0YXJ8ZW58MHx8fHwxNjQ1NDQ1MjIx&ixlib=rb-1.2.1&q=80&w=1080" alt="Avatar">
            </a>
            <h1>Bienvenue sur votre Dashboard</h1>
        </div>
        <article class="flex align-items-center gap-20">
            <a href="/profile">
                <p class="m-0"><?php echo $_SESSION['user']['firstname'] ?><i class="fas fa-user"></i></p>
            </a>
            <button class="buttonsIcon">
                <i class="far fa-moon"></i>
                <i class="fas fa-toggle-off"></i>
            </button>
            <button class="buttonsIcon">
                <a href="/logout"><i class="fas fa-sign-out-alt"></i></a>
            </button>
        </article>
    </section>
<?php endif; ?>