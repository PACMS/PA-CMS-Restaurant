<section id="comments">
    <h1>Avis</h1>

    <?php for ($i=0; $i < count($comments); $i++) { ?>
        <?php $comment = $comments[$i]; ?>
        <?php $responses = $comment->getChildrenComment($comment->getId()) ?>
        <?php 
            if (empty($responses) && is_null($comment->getIdParent())) { ?>
                 <section>
                    <article>
                        <header>
                            <h3>Nom Prénom</h3>
                            <time>Publié le <?= $comment->getCreatedAt() ?></time>
                        </header>
                        <main>
                            <p><?= $comment->getContent() ?></p>
                        </main>
                        <footer>
                            <form>
                                <input type="submit" value="Répondre"></input>
                            </form>
                        </footer>
                    </article>
                </section>
            <?php } else if (!empty($responses) && is_null($comment->getIdParent())) { ?> 
                <section>
                    <article>
                        <header>
                            <h3>Nom Prénom</h3>
                            <time>Publié le <?= $comment->getCreatedAt() ?></time>
                        </header>
                        <main>
                            <p><?= $comment->getContent() ?></p>
                        </main>
                        <footer>
                            <form>
                                <input type="submit" value="Répondre"></input>
                            </form>
                        </footer>
                        <?php for($j = 0; $j < count($responses); $j++) { ?>
                            <?php $response = $responses[$j]; ?>
                            <?php $children = $response->getChildrenComment($response->getId()) ?>
                            <article>
                                <header>
                                    <h3>Nom Prénom</h3>
                                    <time>Publié le <?= $response->getCreatedAt() ?></time>
                                </header>
                                <main>
                                    <p><?= $response->getContent() ?></p>
                                </main>
                                <footer>
                                    <form>
                                        <input type="submit" value="Répondre"></input>
                                    </form>
                                </footer>
                                <?php foreach($children as $child) { ?>
                                    <article>
                                        <header>
                                            <h3>Nom Prénom</h3>
                                            <time>Publié le <?= $child->getCreatedAt() ?></time>
                                        </header>
                                        <main>
                                            <p><?= $child->getContent() ?></p>
                                        </main>
                                        <footer>
                                            <form>
                                                <input type="submit" value="Répondre"></input>
                                            </form>
                                        </footer>
                                    </article>
                                <?php } ?>
                            </article>
                        <?php } ?>
                    </article>
                </section>
            <?php } ?>
    <?php } ?>
</section>