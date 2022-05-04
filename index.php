<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Services\Database;
use App\Services\FlashMessage;
use Symfony\Component\HttpFoundation\Response;



try {
    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("SELECT * FROM truit INNER JOIN user ON truit.user_id = user.id ORDER BY created_at DESC");
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    $truits = $stmt->fetchAll();
} catch (Exception $e) {
    die($e->getMessage());
}

$response = new Response();

$message = FlashMessage::get("message");

ob_start();
require __DIR__ . '/views/index.view.php';
$content = ob_get_clean();

$response->setContent($content);
$response->setStatusCode(Response::HTTP_OK);
$response->headers->set("Content-type", "text/html");
$response->send();
?>

