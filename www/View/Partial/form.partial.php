<form method="<?= $config["config"]["method"]??"POST" ?>"
      action="<?= $config["config"]["action"]??""?>"
      id="<?= $config["config"]["id"]??""?>"
      class="<?= $config["config"]["class"]??""?>"
        <?= $config['config']['file'] ?? '' ?>>


    <?php foreach ($config["inputs"] as $name => $input) :?>



    <?php if ($input["type"] === "radio"): ?>
    <p><?= $input["title"] ?></p>
        <?php foreach ($input['values'] as $value=>$label): ?>
            <input name="<?= $name ?>"
                   class="<?= $input["class"]??"" ?>"
                   id="<?= $value ?? "" ?>"
                   type="<?= $input["type"]??"text" ?>"
                   value="<?= $value ?>"
                <?= !empty( $input["required"])?'required="required"':""  ?>
                <?php if( $input["checked"] === $value): ?>
                    checked="checked"
                <?php endif ?>
            >
            <label for="<?= $value ?>"><?= $label ?></label>
        <?php endforeach ?>
    <?php elseif ($input["type"]  === "checkbox"): ?>
        <p><?= $input["title"] ?></p>
        <?php foreach ($input['values'] as $value=>$label): ?>
            <input name="<?= $name ?>[]"
                   class="<?= $input["class"]??"" ?>"
                   id="<?= $value??"" ?>"
                   type="<?= $input["type"]??"text" ?>"
                   value="<?= $value ?>"
                    <?php if( $input["checked"] === $value): ?>
                    checked="checked"
                <?php endif ?>            >
            <label for="<?= $value ?>"><?= $label ?></label>
        <?php endforeach ?>
    <?php elseif ($input["type"] === "select"): ?>
        <p><?= $input["label"] ?></p>
        <select name="<?= $name ?>"
                class="<?= $input["class"]??"" ?>"
                id="<?= $name ??"" ?>"
                type="<?= $input["type"]??"text" ?>"
            <?= !empty( $input["required"])?'required="required"':""  ?>
        >
            <option disabled="disabled"><?= $input["placeholder"] ?></option>
            <?php foreach ($input['options'] as $value => $label) : ?>
                <option 
                    value="<?= $value ?>" 
                    <?php if ($input["default"] === $value) : ?> selected="selected" <?php endif ?>
                ><?= $label ?></option>
            <?php endforeach ?>
            </select>
            <br>
        <?php elseif ($input["type"] === "textarea") : ?>
            <label for="<?= $name ?>"><?= $input["label"] ?></label>
            <textarea 
                name="<?= $name ?>" 
                placeholder="<?= $input["placeholder"] ?? "" ?>" 
                id="<?= $input["id"] ?>" 
                class="<?= $input["class"] ?>" 
                maxlength="<?= $input["maxlength"] ?>" 
                <?= !empty($input["required"]) ? 'required="required"' : ""  ?>>
            </textarea>
            <br>
        <?php elseif ($input["type"] === "file") : ?>
            <label for="<?= $name ?>"><?= $input["label"] ?></label>
            <?php $concatAccept = "" ?>
            <?php foreach ($input['accept'] as $value => $label) : ?>
                <?php $concatAccept .= $label . ", " ?>
            <?php endforeach ?>
            <?php $concatAccept = substr($concatAccept, 0, -2) ?>

            <input 
                name="<?= $name ?>" 
                id="<?= $input["id"] ?>" 
                class="<?= $input["class"] ?>" 
                type="<?= $input["type"] ?>" 
                accept="<?= $concatAccept ?>" 
                <?= !empty($input["required"]) ? 'required="required"' : ""  ?>
            />
        <?php elseif ($input["type"] === "captcha") : ?>
            <input 
                type="hidden" 
                name="<?= $name ?>" 
                id="recaptchaResponse"
            />
        <?php else : ?>
            <input 
                name="<?= $name ?>" 
                class="<?= $input["class"] ?? "" ?>" 
                id="<?= $input["id"] ?? "" ?>" 
                placeholder="<?= $input["placeholder"] ?? "" ?>" 
                type="<?= $input["type"] ?? "text" ?>" 
                <?= !empty($input["required"]) ? 'required="required"' : ""  ?>
            />
            <br>
        <?php endif ?>


    <?php endforeach; ?>
    <br>
    <input 
        type="submit" 
        value="<?= $config["config"]["submit"] ?? "Envoyer" ?>"
    />
</form>

<?php if ($config["config"]["captcha"]) : ?>
    <script src="https://www.google.com/recaptcha/api.js?render=6LcQTkkeAAAAAI6N0EAB_kuo7HnT7xb_qoRwgSZV"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LcQTkkeAAAAAI6N0EAB_kuo7HnT7xb_qoRwgSZV', {
                action: 'homepage'
            }).then(function(token) {
                document.getElementById('recaptchaResponse').value = token
            });
        });
    </script>
<?php endif ?>