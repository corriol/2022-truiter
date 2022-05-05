<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    \App\Services\FlashMessage::set("errors", ["Solo por POST"]);
    header('Location: /register');
    exit();
}

$data = [];
$errors = [];

$data["name"] = $_POST["name"] ?? "";
$data["username"] = $_POST["username"] ?? "";
$data["email"] = $_POST["email"]?? "";
$data["password"] = $_POST["password"] ?? "";

$errors = validate_user($data);

if (count($errors)>0) {
    \App\Services\FlashMessage::set("errors", $errors);
    header('Location: /register');
    exit();
}

$data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);


if (empty($errors)){
    try {
        $pdo = new PDO("mysql:host=mysql-server;dbname=truiter;charset=utf8", "root", "secret");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Implementacio de la consulta amb la base de dades

        $stmt = $pdo->prepare("INSERT INTO user 
            (name, username, email, password) VALUES (:name,:username,:email,:password)");

        // TODO: Una solució alternativa més curta

        /* $stmt->bindValue("nombre",$data["nombre"]);
        $stmt->bindValue("nickname", $data["nickname"]);
        $stmt->bindValue("email", $data["email"]);
        $stmt->bindValue("password", $data["password"]);
        $stmt->execute();*/

        $stmt->execute($data);



    }catch (PDOException $exception){
        echo "Error en la base de datos " . $exception->getMessage();
    }
    // TODO: Error incontrolat
    //header("location: login.php");
    //exit();
}else{
    $_SESSION["errors"] = $errors;
    //header("location: register.php");
    //exit();
}

