<?php

require_once __DIR__ . '/vendor/autoload.php';

use Webmozart\Assert\Assert;

function timePassed(DateTime $date): string {

    return $date->format("Y-m-d h:i:s");
}

function validate_user(array $user): array {

    $errors = [];

    try {
        Assert::notEmpty($user["name"]);

    }catch (Exception $e){
        $errors[] = "Nombre: {$e->getMessage()}";
    }

    try {
        Assert::notEmpty($user["username"]);

    }catch (Exception $e){
        $errors[] = "Nickname: {$e->getMessage()}";
    }

    try {
        Assert::email($user["email"], "El correu electrònic és invalid");
       // validate_email($user["email"]);

    }catch (Exception $e){
        $errors[] = "Email: {$e->getMessage()}";
    }

    try {
        validate_string($user["password"]);

    }catch (Exception $e){
        $errors[] = "Password: {$e->getMessage()}";
    }

    return $errors;
}

function clean($data)
{
    $data = trim($data);
    return htmlspecialchars($data);
}

function validate_string(string $string, $maxLength = 255){
    if (empty($string)){
        throw new Exception();
    }elseif (strlen($string) > $maxLength){
        throw new Exception();
    }
}

function isValidEmail(string $email):bool {
    return is_string(filter_var($email, FILTER_VALIDATE_EMAIL));
}
function validate_email(string $email, $maxLength = 255){
    if (empty($email)){
        throw new Exception("Email no pot ser buit");
    }elseif (strlen($email) > $maxLength){
        throw new Exception("Email és massa llarg");
    }elseif (!isValidEmail($email)){
        throw new Exception("Email és invàlid");
    }
}

function validate_file(array $files){
    $tipo = $files["type"];
    $extension = explode("/", $tipo)[1];

    if (empty($files)){
        throw new Exception();
    } else if ($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png"){
        throw new Exception();
    }
}

function validate_message(string $string, $minLenght = 1, $maxLenght = 140){
    if (empty($string)){
        throw new Exception();
    }else if (strlen($string) < $minLenght){
        throw new Exception();
    }elseif(strlen($string) > $maxLenght){
        throw new Exception();
    }
}