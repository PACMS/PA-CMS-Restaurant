<form method="<?php echo $config["config"]["method"]??"POST" ?>"
      action="<?php echo $config["config"]["action"]??""?>"
      id="<?php echo $config["config"]["id"]??""?>"
      class="<?php echo $config["config"]["class"]??""?>"
        <?php echo $config['config']['file'] ?? '' ?>>


    <?php foreach ($config["inputs"] as $name => $input) :?>



        <?php if ($input["type"] === "radio") : ?>
    <p><?php echo $input["title"] ?></p>
            <?php foreach ($input['values'] as $value=>$label): ?>
            <input name="<?php echo $name ?>"
                   class="<?php echo $input["class"]??"" ?>"
                   id="<?php echo $value ?? "" ?>"
                   type="<?php echo $input["type"]??"text" ?>"
                   value="<?php echo $value ?>"
                <?php echo !empty($input["required"])?'required="required"':""  ?>
                <?php if($input["checked"] === $value) : ?>
                    checked="checked"
                <?php endif ?>
            >
            <label for="<?php echo $value ?>"><?php echo $label ?></label>
            <?php endforeach ?>
    <?php elseif ($input["type"]  === "checkbox") : ?>
        <p><?php echo $input["title"] ?></p>
        <?php foreach ($input['values'] as $value=>$label): ?>
            <input name="<?php echo $name ?>[]"
                   class="<?php echo $input["class"]??"" ?>"
                   id="<?php echo $value??"" ?>"
                   type="<?php echo $input["type"]??"text" ?>"
                   value="<?php echo $value ?>"
                    <?php if($input["checked"] === $value) : ?>
                    checked="checked"
                    <?php endif ?>            >
            <label for="<?php echo $value ?>"><?php echo $label ?></label>
        <?php endforeach ?>
    <?php elseif ($input["type"] === "select") : ?>
        <p><?php echo $input["label"] ?></p>
        <select name="<?php echo $name ?>"
                class="<?php echo $input["class"]??"" ?>"
                id="<?php echo $name ??"" ?>"
                type="<?php echo $input["type"]??"text" ?>"
            <?php echo !empty($input["required"])?'required="required"':""  ?>
        >
            <option disabled="disabled"><?php echo $input["placeholder"] ?></option>
            <?php foreach ($input['options'] as $value => $label) : ?>
                <option 
                    value="<?php echo $value ?>" 
                    <?php if ($input["default"] === $value) : ?> selected="selected" <?php 
                    endif ?>
                ><?php echo $label ?></option>
            <?php endforeach ?>
            </select>
            <br>
        <?php elseif ($input["type"] === "textarea") : ?>
            <label for="<?php echo $name ?>"><?php echo $input["label"] ?></label>
            <textarea 
                name="<?php echo $name ?>" 
                placeholder="<?php echo $input["placeholder"] ?? "" ?>" 
                id="<?php echo $input["id"] ?>" 
                class="<?php echo $input["class"] ?>" 
                maxlength="<?php echo $input["maxlength"] ?>" 
                <?php echo !empty($input["required"]) ? 'required="required"' : ""  ?>>
            </textarea>
            <br>
        <?php elseif ($input["type"] === "file") : ?>
            <label for="<?php echo $name ?>"><?php echo $input["label"] ?></label>
            <?php $concatAccept = "" ?>
            <?php foreach ($input['accept'] as $value => $label) : ?>
                <?php $concatAccept .= $label . ", " ?>
            <?php endforeach ?>
            <?php $concatAccept = substr($concatAccept, 0, -2) ?>

            <input 
                name="<?php echo $name ?>" 
                id="<?php echo $input["id"] ?>" 
                class="<?php echo $input["class"] ?>" 
                type="<?php echo $input["type"] ?>" 
                accept="<?php echo $concatAccept ?>" 
                <?php echo !empty($input["required"]) ? 'required="required"' : ""  ?>
            />
        <?php elseif ($input["type"] === "captcha") : ?>
            <input 
                type="hidden" 
                name="<?php echo $name ?>" 
                id="recaptchaResponse"
            />
        <?php else : ?>
            <?php if (!empty($input["label"])) : ?>
                <label for="<?= $name ?>"><?= $input["label"] ?></label>
            <?php endif ?>

            <input 
                name="<?php echo $name ?>" 
                class="<?php echo $input["class"] ?? "" ?>" 
                id="<?php echo $input["id"] ?? "" ?>" 
                placeholder="<?php echo $input["placeholder"] ?? "" ?>" 
                type="<?php echo $input["type"] ?? "text" ?>" 
                <?php echo !empty($input["required"]) ? 'required="required"' : ""  ?>
            />

        <?php endif ?>


    <?php endforeach; ?>
    <input 
        type="submit" 
        value="<?php echo $config["config"]["submit"] ?? "Envoyer" ?>"
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
