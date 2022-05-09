<?php
session_start();
require_once "helpers.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Solo se aceptan datos por POST");
}

if (empty($_SESSION["user"])) {
    die("No has iniciat sessió");
}

$errors = [];
$message = "";
$message = filter_input(INPUT_POST, "text");

try {
    if (empty($message))
        throw new Exception("El tuit no pot ser buit");


    if (strlen($message) > 140)
        throw new Exception("El truit és massa llarg");

} catch (Exception $e) {
    $errors[] = "Tuit: {$e->getMessage()}";
}

if (empty($errors)) {

    $date = new DateTime();

    try {
        $pdo = new PDO("mysql:host=mysql-server;dbname=truiter;charset=utf8", "root", "secret");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Implementacio de la consulta amb la base de dades

        $stmt = $pdo->prepare("INSERT INTO truit (user_id, text, created_at) VALUES (:user_id, :descripcion,:dada)");

        $stmt->bindValue("user_id", $_SESSION["user"]["id"]);
        $stmt->bindValue("descripcion", $message);
        $stmt->bindValue("dada", $date->format("Y-m-d h:i:s"));

        $stmt->execute();

        echo "El tuit s'ha creat";

    } catch (Exception $exception) {
        die("Error en la base de datos " . $exception->getMessage());
    }

} else {
    foreach ($errors as $error) {
        echo "<p>$error</p>";
    }

    echo "<a href='index.php'>Volver a Inicio</a>";

}