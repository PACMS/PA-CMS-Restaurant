<?php

namespace App\Core;

use App\Model\User as UserModel;

class Verificator extends Sql
{
    public static function checkForm($config, $data): array
    {
        $errors = [];

        if (count($config["inputs"]) != count($_POST + $_FILES)) {
            die("Tentative de hack");
        }

        foreach ($config["inputs"] as $name => $input) {
            if (!in_array($name, array_keys($data))) {
                die('Modification des données !!!');
            }

            if (!isset($data[$name])) {
                $errors[] = "Il manque le champ : " . $name;
            }

            if (!empty($input["required"]) && empty($data[$name])) {
                $errors[] = 'Le champ ' . $name . " ne peut pas être vide";
            }
            if (!empty($input["confirm"]) && $data[$name] != $data[$input["confirm"]]) {
                $errors[] = $input["error"];
            }
            if (!empty($input['min']) && !self::min($data[$name], $input['min'])) {
                $errors[] = $input["error"];
            }
            if (!empty($input['max']) && !self::max($data[$name], $input['max'])) {
                $errors[] = $input["error"];
            }
            if (!empty($input['unicity']) && !self::unicity($data[$name], $input['unicity'])) {
                $errors[] = $input["errorUnicity"];
            }

            if ($input['type'] == "email" && !self::checkEmail($data[$name])) {
                $errors[] = $input["error"];
            }
            if ($input["type"] == "password" && !self::checkPwd($data[$name]) && empty($input["confirm"])) {
                $errors[] = $input["error"];
            }
            if ($input["type"] == "radio" && !self::checkRadio($data[$name], $input["values"])) {
                $errors[] = $input["error"];
            }
            if ($input["type"] == "checkbox" && !self::checkCheckbox($input["values"], $data[$name])) {
                $errors[] = $input["error"];
            }
            if ($input["type"] == "select" && !self::checkSelect($data[$name], $input["options"])) {
                $errors[] = $input["error"];
            }
            if ($input["type"] == 'file' && !empty($data[$name]['name']) && !self::checkFile($data[$name]['name'], $input["accept"])) {
                $errors[] = $input["error"];
            }
            if ($input["type"] == 'captcha' && !self::checkCaptcha($data[$name])) {
                $errors[] = $input["error"];
            }
        }

        return $errors;
    }

    public static function min($value, $min): bool
    {
        return strlen($value) > $min;
    }

    public static function max($value, $max): bool
    {
        return strlen($value) < $max;
    }

    public static function checkEmail($email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function unicity($value, $table)
    {
        if ((new Verificator())->databaseFindOne(['email' => $value], $table)) {
            return false;
        } else {
            return true;
        }
    }

    public static function checkPwd($pwd): bool
    {
        return strlen($pwd) >= 8 && preg_match("/[0-9]/", $pwd, $result) && preg_match("/[A-Z]/", $pwd, $result);
    }

    public static function checkRadio($option, $data): bool
    {
        return array_key_exists($option, $data);
    }

    public static function checkCheckbox($data, $values): bool
    {
        foreach ($values as $optionsId) {
            if (!array_key_exists($optionsId, $data)) {
                return false;
            }
        }

        return true;
    }

    public static function checkSelect($option, $data): bool
    {
        return array_key_exists($option, $data);
    }

    public static function checkFile($currentExtension, $dataExtension): bool
    {
        $extension =  pathinfo($currentExtension, PATHINFO_EXTENSION);
        return array_key_exists($extension, $dataExtension);
    }

    public static function checkCaptcha($value): bool
    {
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=6LcQTkkeAAAAAPD-IViqaHsMOuj_iWFpFBKZuzGm&response={$value}";
        $response = file_get_contents($url);
        $data = json_decode($response);

        if ($data->success) {
            return true;
        } else {
            return false;
        }
    }
}
