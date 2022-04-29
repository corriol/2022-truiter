<?php
session_start();

require_once __DIR__ . "/src/Services/Database.php";
require_once __DIR__ . '/src/Services/FlashMessage.php';

try {

    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username");

    // TODO: Cal validar i sanejar
    $username = filter_input(INPUT_POST ,"username");
    if (empty($username))
        throw new Exception("El nom d'usuari és obligatori");

    $password = filter_input(INPUT_POST ,"password");

    $stmt->bindValue("username", $username);

    $result = $stmt->execute();

    if (!$result)
        throw new Exception("Error en la consulta");

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user["password"])) {
            $_SESSION["user"] = $user;

            FlashMessage::set("message", "L'usuari {$user["username"]} ha iniciat sessió correctament");
            header("Location: /index.php");
            exit();
        }
        else
            throw new Exception("Contrasenya invàlida");
    } else
        throw new Exception("Usuari invàlid");

}
catch (Exception $e) {
    FlashMessage::set("error", "Ha hagut un error: {$e->getMessage()}");
    header("Location: /login.php");
    exit();
}



