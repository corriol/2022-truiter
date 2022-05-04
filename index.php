<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Services\Database;

include 'helpers.php'

?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <title>Truiter: una grollera còpia de Twitter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<body>

<?php

require_once __DIR__ . '/src/Services/FlashMessage.php';

session_start();

try {
    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("SELECT * FROM truit INNER JOIN user ON truit.user_id = user.id ORDER BY created_at DESC");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    $truits = $stmt->fetchAll();
} catch (Exception $e) {
    die($e->getMessage());
}

?>

<main class="border-top mt-4 border-4 border-primary container">
    <div class="row">
        <div class="position-fixed col-2 border d-flex flex-column justify-content-between h-75">
            <?php require "partial/sidebar.php" ?>
        </div>
        <div class="offset-3 col-7 border p-4">
            <h2>Darrers truits</h2>
            <?php
            $message = FlashMessage::get("message");
            if (!empty($message)) :?>
                <div class="alert alert-primary" role="alert"><?=$message?></div>
            <?php endif;?>
            <?php if (!empty($_SESSION["user"])) : ?>
                <form class="mb-4" method="post" action="tuit-process.php">
                    <textarea name="text" class="form-control mb-2" placeholder="Què passa, [nom d'usuari]?"></textarea>
                    <button type="submit" class="btn btn-primary">Tuit</button>
                    <a class="btn btn-secondary" href="tuit-with-image.php"">
                    <i class="bi color-primary bi-image"></i> Tuit amb imatge</a>
                </form>
            <?php endif; ?>
            <?php foreach ($truits as $truit) : ?>
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title"><?= $truit["name"] ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">@<?= $truit["username"] ?></h6>
                        <p class="card-text"><?= $truit["text"] ?></p>

                        <?php if (!empty($truit["image"])) : ?>
                            <div  style="width: 150px; height: auto" >
                                <img class="w-100 h-100" style="object-fit: scale-down" src="images/<?=$truit["image"]?>" alt="image"/>
                            </div>
                        <?php else :?>

                        <?php endif;?>

                    </div>
                    <div class="card-footer text-muted">
                        <?= timePassed(DateTime::createFromFormat("Y-m-d h:i:s", $truit["created_at"])); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="col-3 border"></div>
    </div>
</main>
</body>
</html>