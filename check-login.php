<?php
session_start();
try {

    $pdo = new PDO("mysql:host=127.0.0.1;dbname=truiter;user=root;password=secret");
    $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username");

    // TODO: Cal validar i sanejar
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt->bindValue("username", $username);

    $result = $stmt->execute();

    if (!$result)
        throw new Exception("Error en la consulta");

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user["password"])) {
            $_SESSION["user"] = $user;
            echo "L'usuari {$user["username"]} ha iniciat sessió correctament";
        }
        else
            throw new Exception("Contrasenya invàlida");
    } else
        throw new Exception("Usuari invàlid");

}
catch (Exception $e) {
    die($e->getMessage());
}



