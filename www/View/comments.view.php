<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.bundle.min.js"></script>

<main class="flex pageDashboard">
    <?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="flex flex-column secondPart">
    <?php $this->includePartial("topBar", ["title" => "Commentaires"]); ?>
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