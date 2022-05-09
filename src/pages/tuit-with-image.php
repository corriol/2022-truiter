<!DOCTYPE html>
<html lang="ca">
<head>
    <title>Tuiter: una grollera còpia de Twitter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<body>

<main class="border-top mt-4 border-4 border-primary container">
    <div class="row">
        <div class="col-2 border d-flex flex-column justify-content-between">
                <?php require "partial/sidebar.php" ?>
        </div>
        <div class="col-7 border p-4">
            <h2>Nou truit amb imatge</h2>
            <form class="mb-4" action="/pages/tuit-with-image-process.phpss.php" method="POST" enctype="multipart/form-data">
                <textarea class="form-control mb-2" placeholder="Què passa, [nom d'usuari]?" name="text"></textarea>
                <input type="file" class="form-control mb-2" name="image">
                <button class="btn btn-primary">Tuit with image</button>
            </form>
        </div>
        <div class="col-3 border"></div>
    </div>
</main>
</body>
</html>