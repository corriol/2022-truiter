<?php

$errores = \App\Services\FlashMessage::get('errors', [])

?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <title>Truiter: una grollera còpia de Twitter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<style>
    .rojo {
        color: red;
    }
</style>
<body>

<main class="border-top mt-4 border-4 border-primary container">
    <div class="row">
        <div class="col-2 border d-flex flex-column justify-content-between">
            <?php require "partial/sidebar.php" ?>
        </div>
        <div class="col-7 border p-4">
            <?php if (!empty($errores)): ?>
                <div class="col-12 mt-3">
                    <?php foreach ($errores as $key => $error): ?>
                        <p class="rojo"><?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <h2>Registrar-se</h2>
            <form class="mb-4" method="post" action="/check-register">
                <label for="usuario" class="form-label">Nom</label>

                <input id="usuario" class="form-control" name="name">

                <label for="nickname" class="form-label">Nom d'usuari</label>
                <input id="nickname" class="form-control" name="username">

                <label for="email" class="form-label">Correu electrònic</label>
                <input type="text" id="email" class="form-control" name="email">

                <label for="password" class="form-label">Contrasenya</label>
                <input type="password" id="password" class="form-control mb-2" name="password">

                <button class="btn btn-primary">Registrar-se</button>
            </form>

        </div>
        <div class="col-3 border"></div>
    </div>
</main>
</body>
</html>