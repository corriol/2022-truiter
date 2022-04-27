<!DOCTYPE html>
<html lang="ca">
<head>
    <title>Truiter: una grollera còpia de Twitter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<body>

<main class="border-top mt-4 border-4 border-primary container">
    <div class="row">
        <div class="col-2 border d-flex flex-column justify-content-between">
            <?php require "partial/sidebar.php"?>
        </div>
        <div class="col-7 border p-4">
            <h2>Inici de sessió</h2>
            <form class="mb-4" method="post" action="check-login.php">
                <label for="usuario" class="form-label"">Usuari</label>
                    <input id="usuario mb-2" class="form-control" name="username" >

                <label for="password" class="form-label">Contrasenya</label>
                    <input id="password" type="password" class="form-control mb-2" name="password">


                <button class="btn btn-primary">Iniciar sessió</button>
            </form>

        </div>
        <div class="col-3 border"></div>
    </div>
</main>
</body>
</html>