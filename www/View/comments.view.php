<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.bundle.min.js"></script>

<main class="flex pageDashboard">
    <?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
        <section class="navbar">
            <div class="flex align-items-center">
                <!-- <img src="https://images.unsplash.com/photo-1527980965255-d3b416303d12?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxMTgwOTN8MHwxfHNlYXJjaHw2fHxhdmF0YXJ8ZW58MHx8fHwxNjQ1NDQ1MjIx&ixlib=rb-1.2.1&q=80&w=1080" alt="Avatar"> -->
                <h1>Commentaires</h1>
            </div>
            <article class="flex align-items-center gap-20">
                <a href="profile">
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
        <section style="padding-right: 4%;">




            <div class="comments">
                <div class="toValidate">
                    <?php foreach ($comments as $value) : ?>
                        <?php if ($value->getStatus() == 0) : ?>
                            <div style="gap: 10px" class="flex align-items-center">
                                <p>User :<?= $value->getIdUser() ?></p>
                                <p><?= $value->getContent() ?></p>
                                <p>status :<?= $value->getStatus() ?></p> <?php $this->includePartial("form", $comment->validateComment($value->getId())); ?><?php $this->includePartial("form", $comment->deleteComment($value->getId())); ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="validated">
                    <?php foreach ($comments as $value) : ?>
                        <?php if ($value->getStatus() == 1) : ?>
                                <div style="gap: 10px" class="flex align-items-center">
                                    <p>User :<?= $value->getIdUser() ?></p>
                                    <p><?= $value->getContent() ?></p>
                                    <p>status :<?= $value->getStatus() ?></p> <?php $this->includePartial("form", $comment->validateComment($value->getId())); ?><?php $this->includePartial("form", $comment->deleteComment($value->getId())); ?>
                                </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>



            </div>
        </section>
    </section>

</main>

<script type="text/jaascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>