<main class="flex pageDashboard">
<?php $this->includePartial("sidebar"); ?>
    <div id="pseudo-element"></div>
    <section class="cards-page">
    <?php $this->includePartial("topBar", ["title" => "Cartes"]); ?>
        <div class="flex flex-column ">
            <?php if (file_exists('/public/assets/img/qrcode/qrcode' . $restaurant->getId() . '.svg')){ ?>
                <a id="" href="/public/assets/img/qrcode/qrcode<?php echo $restaurant->getId() ?>.svg"  class="flex justify-content-center btn btn-submit w-64 mr-3  " download>Télécharger le Qrcode de la carte</a>
            <?php }?>
            <div class="flex flex-row align-items-center">
                <?php if (file_exists('/public/assets/img/qrcode/qrcode' . $restaurant->getId() . '.svg')){ ?>
                    <img class="w-48 " src="/public/assets/img/qrcode/qrcode<?php echo $restaurant->getId() ?>.svg" alt="qrcode<?php echo $restaurant->getId() ?>">
                <?php }else echo '<p class="mr-3"> Pas de page carte créé </p>' ?>
                <a id="" href="#open-modalQrcode"  class="flex justify-content-center btn btn-submit w-48 ">Modifier le Qrcode</a>
            </div>
            <div id="open-modalQrcode" class="modal-windowQrcode">
                <div class="flex flex-column ">
                    <a href="#" title="Close" class="modal-close ">x</a>
                    <form method="POST" action="/restaurant/QrcodeEdit" enctype="multipart/form-data">
                        <label class="greytext" for="logo">Logo</label>
                        <input class="mb-7" id="logo" name="logo" type="file">

                        <label class="greytext" for="color">Couleur du Qrcode</label>
                        <input class="mb-7 p-0" id="color" name="color" value="" type="color" >
                        <div class="flex flex-column">
                            <div class="flex flex-row">
                                <!-- Style du qrcode -->
                                <div class="flex flex-column  ">
                                    <label class="greytext" for="style">Style du Qrcode</label>
                                    <div class="flex flex-row flex-wrap align-items-center gap-3  ">
                                        <div class="flex w-full grow align-items-center  gap-3 ">
                                            <img class="w-12" src="/public/assets/img/styleQrcode/default.png" alt="default">
                                            <input class="" id="style" name="style" value="default" type="radio" checked>
                                            <label class="greytext " for="style1">Default</label>

                                            <img class="w-12" src="/public/assets/img/styleQrcode/arrow.png" alt="arrow">
                                            <input class="" id="style" name="style" value="arrow" type="radio">
                                            <label class="greytext  " for="style2">Arrow</label>
                                        </div>
                                        <div class="flex w-full grow align-items-center gap-3">
                                            <img class="w-12" src="/public/assets/img/styleQrcode/circle.png" alt="circle">
                                            <input class="" id="style" name="style" value="circle" type="radio">
                                            <label class="greytext " for="style3">Circle</label>

                                            <img class="w-12" src="/public/assets/img/styleQrcode/classic.png" alt="classic">
                                            <input class="" id="style" name="style" value="classic" type="radio">
                                            <label class="greytext  "  for="style4">Classic</label>
                                        </div>
                                        <div class="flex w-full grow align-items-center gap-3 mb-3">
                                            <img class="w-12" src="/public/assets/img/styleQrcode/heavyround.png" alt="heavyround">
                                            <input class="" id="style" name="style" value="heavyround" type="radio">
                                            <label class="greytext " for="style5">Heavyround</label>

                                            <img class="w-12" src="/public/assets/img/styleQrcode/lightround.png" alt="lightround">
                                            <input class="" id="style" name="style" value="lightround" type="radio">
                                            <label class="greytext  " for="style6">Lightround</label>
                                        </div>
                                        <img class="w-12" src="/public/assets/img/styleQrcode/sieve.png" alt="sieve">
                                        <input class="" id="style" name="style" value="sieve" type="radio">
                                        <label class="greytext " for="style7">Sieve</label>
                                    </div>
                                </div>

                                <div class="flex flex-column">
                                    <label class="greytext" for="style">Style Oeil interieur du Qrcode</label>
                                    <div class="flex flex-row flex-wrap align-items-center gap-3  ">
                                        <div class="flex w-full grow align-items-center  gap-3 ">
                                    <!-- Oeil interieur du qrcode -->
                                            <img class="w-12" src="/public/assets/img/styleInner/default_inner.png" alt="default_inner">
                                            <input class=" id="style" name="style_inner" value="default" type="radio" checked>
                                            <label class="greytext" for="style1">Default</label>

                                            <img class="w-12" src="/public/assets/img/styleInner/circle_inner.png" alt="circle_inner">
                                            <input class="" id="style" name="style_inner" value="circle" type="radio">
                                            <label class="greytext" for="style2">Circle</label>
                                        </div>
                                        <div class="flex w-full grow align-items-center  gap-3 ">
                                            <img class="w-12" src="/public/assets/img/styleInner/cushion_inner.png" alt="cushion_inner">
                                            <input class="" id="style" name="style_inner" value="cushion" type="radio">
                                            <label class="greytext" for="style3">Cushion</label>

                                            <img class="w-12" src="/public/assets/img/styleInner/diamond_inner.png" alt="diamond_inner">
                                            <input class="" id="style" name="style_inner" value="diamond" type="radio">
                                            <label class="greytext" for="style4">Diamond</label>
                                        </div>
                                        <div class="flex w-full grow align-items-center  gap-3 ">
                                            <img class="w-12" src="/public/assets/img/styleInner/dots_inner.png" alt="dots_inner">
                                            <input class="" id="style" name="style_inner" value="dots" type="radio">
                                            <label class="greytext" for="style5">Dots</label>

                                            <img class="w-12" src="/public/assets/img/styleInner/heavyround_inner.png" alt="heavyround_inner">
                                            <input class="" id="style" name="style_inner" value="heavyround" type="radio">
                                            <label class="greytext" for="style6">Heavyround</label>
                                        </div>
                                        <div class="flex w-full grow align-items-center  gap-3 ">
                                            <img class="w-12" src="/public/assets/img/styleInner/leaf_inner.png" alt="leaf_inner">
                                            <input class="" id="style" name="style_inner" value="leaf" type="radio">
                                            <label class="greytext" for="style7">Leaf</label>

                                            <img class="w-12" src="/public/assets/img/styleInner/left_eye_inner.png" alt="left_eye_inner">
                                            <input class="" id="style" name="style_inner" value="left_eye" type="radio">
                                            <label class="greytext" for="style8">Left_eye</label>
                                        </div>
                                        <div class="flex w-full grow align-items-center  gap-3 ">
                                            <img class="w-12" src="/public/assets/img/styleInner/right_eye_inner.png" alt="right_eye_inner">
                                            <input class="" id="style" name="style_inner" value="right_eye" type="radio">
                                            <label class="greytext" for="style9">Right_eye</label>

                                            <img class="w-12" src="/public/assets/img/styleInner/shield_inner.png" alt="shield_inner">
                                            <input class="" id="style" name="style_inner" value="shield" type="radio">
                                            <label class="greytext" for="style10">Shield</label>
                                        </div>
                                        <div class="flex w-full grow align-items-center  gap-3 ">
                                            <img class="w-12" src="/public/assets/img/styleInner/sieve_inner.png" alt="sieve_inner">
                                            <input class="" id="style" name="style_inner" value="sieve" type="radio">
                                            <label class="greytext" for="style11">Sieve</label>

                                            <img class="w-12" src="/public/assets/img/styleInner/star_inner.png" alt="star_inner">
                                            <input class="" id="style" name="style_inner" value="star" type="radio">
                                            <label class="greytext" for="style12">Star</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-column">
                                    <label class="greytext" for="style">Style Oeil extérieur du Qrcode</label>
                                    <div class="flex flex-row flex-wrap align-items-center gap-3  ">
                                        <div class="flex w-full grow align-items-center  gap-3 ">
                                            <img class="w-12" src="/public/assets/img/styleOuter/default_outer.png" alt="default_outer">
                                            <input class="" id="style" name="style_outer" value="default" type="radio" checked>
                                            <label class="greytext" for="style1">Default</label>

                                            <img class="w-12" src="/public/assets/img/styleOuter/circle_outer.png" alt="circle_outer">
                                            <input class="" id="style" name="style_outer" value="circle" type="radio">
                                            <label class="greytext" for="style2">Circle</label>
                                        </div>
                                        <div class="flex w-full grow align-items-center  gap-3 ">
                                            <img class="w-12" src="/public/assets/img/styleOuter/cushion_outer.png" alt="default_outer">
                                            <input class="" id="style" name="style_outer" value="cushion" type="radio">
                                            <label class="greytext" for="style3">Cushion</label>

                                            <img class="w-12" src="/public/assets/img/styleOuter/diamond_outer.png" alt="diamond_outer">
                                            <input class="" id="style" name="style_outer" value="diamond" type="radio">
                                            <label class="greytext" for="style4">Diamond</label>
                                        </div>
                                        <div class="flex w-full grow align-items-center  gap-3 ">
                                            <img class="w-12" src="/public/assets/img/styleOuter/dots_outer.png" alt="dots_outer">
                                            <input class="" id="style" name="style_outer" value="dots" type="radio">
                                            <label class="greytext" for="style5">Dots</label>

                                            <img class="w-12" src="/public/assets/img/styleOuter/heavyround_outer.png" alt="heavyround_outer">
                                            <input class="" id="style" name="style_outer" value="heavyround" type="radio">
                                            <label class="greytext" for="style6">Heavyround</label>
                                        </div>
                                        <div class="flex w-full grow align-items-center  gap-3 ">
                                            <img class="w-12" src="/public/assets/img/styleOuter/leaf_outer.png" alt="leaft_outer">
                                            <input class="" id="style" name="style_outer" value="leaf" type="radio">
                                            <label class="greytext" for="style7">Leaf</label>

                                            <img class="w-12" src="/public/assets/img/styleOuter/left_eye_outer.png" alt="left_outer">
                                            <input class="" id="style" name="style_outer" value="left_eye" type="radio">
                                            <label class="greytext" for="style8">Left_eye</label>
                                        </div>
                                        <div class="flex w-full grow align-items-center  gap-3 ">
                                            <img class="w-12" src="/public/assets/img/styleOuter/right_eye_outer.png" alt="right_outer">
                                            <input class="" id="style" name="style_outer" value="right_eye" type="radio">
                                            <label class="greytext" for="style9">Right_eye</label>

                                            <img class="w-12" src="/public/assets/img/styleOuter/shield_outer.png" alt="shield_outer">
                                            <input class="" id="style" name="style_outer" value="shield" type="radio">
                                            <label class="greytext" for="style10">Shield</label>
                                        </div>
                                        <div class="flex w-full grow align-items-center  gap-3 ">
                                            <img class="w-12" src="/public/assets/img/styleOuter/sieve_outer.png" alt="sieve_outer">
                                            <input class="" id="style" name="style_outer" value="sieve" type="radio">
                                            <label class="greytext" for="style11">Sieve</label>

                                            <img class="w-12" src="/public/assets/img/styleOuter/star_outer.png" alt="star_outer">
                                            <input class="" id="style" name="style_outer" value="star" type="radio">
                                            <label class="greytext" for="style12">Star</label
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" value="Modifier">
                    </form>
                </div>
            </div>
        </div>
        <section class="list-cards">
            <?php foreach ($cartes as $key => $value) : ?>
                <article class="card">
                    <img src="../public/src/pizza.jpg" alt="graph" />
                    <footer>
                        <h3 class="linkMeal" data-id-card="<?= $value->getId() ?>"><?= $value->getName() ?></h3>
                        <h6><?= $restaurant->getName() ?></h6>
                        <button id="state-card" class="<?= $value->getStatus() ? "active" : "" ?>"><?= $value->getStatus() ? "Activé" : "Désactivé" ?></button>
                    </footer>
                    </a>
                    <?php if($_SESSION["user"]["role"] == "admin"): ?>

                    <a href="?id=<?= $value->getId() ?>">
                        <svg id="edit-card" width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_641_4396)">
                                <path d="M3.36548 16.668V19.7195H7.12968L18.2316 10.7196L14.4674 7.66814L3.36548 16.668ZM21.1426 8.35981C21.534 8.04246 21.534 7.52981 21.1426 7.21245L18.7937 5.30833C18.4022 4.99097 17.7698 4.99097 17.3784 5.30833L15.5414 6.79745L19.3056 9.84894L21.1426 8.35981Z" fill="#0051EF" />
                            </g>
                            <defs>
                                <clipPath id="clip0_641_4396">
                                    <rect width="24.0909" height="21.9707" fill="white" transform="translate(0.354004 0.189453)" />
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
            <?php if($_SESSION["user"]["role"] == "admin"): ?>

            <article class="card create">
                <a href="/restaurant/carte/create">
                    <main>
                        <svg id="add-card" width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <line x1="45" y1="26" x2="45" y2="63" stroke="#0051EF" stroke-width="8" stroke-linecap="round" />
                            <line x1="26" y1="45" x2="63" y2="45" stroke="#0051EF" stroke-width="8" stroke-linecap="round" />
                            <circle cx="45" cy="45" r="44.5" fill="white" fill-opacity="0.1" stroke="#007AFF" />
                        </svg>
                    </main>
                    <footer>
                        <h3>Ajouter une carte</h3>
                        <h6><?= $restaurant->getName() ?></h6>
                        <button id="state-card" class="active">Créer</button>
                    </footer>
                </a>
            </article>
            <?php endif; ?>
        </section>
    </section>
</main>

<script>
    $("h3.linkMeal").click(function(e) {
        $.post("/restaurant/carte/meals/sendId", {
            id: e.target.getAttribute("data-id-card")
        }, function() {
            location.href = '/restaurant/carte/meals';
        });
    });
</script>
