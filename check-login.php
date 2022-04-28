<?php
session_start();
try {

    $pdo = new PDO("mysql:host=mysql-server;dbname=truiter;user=root;password=secret");
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



