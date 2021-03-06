<?php

namespace App\Controllers;


use App\Services\Database;
use App\Services\FlashMessage;
use Exception;
use PDO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGenerator;

class DefaultController
{
    function index(Request $request, UrlGenerator $generator): Response
    {

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
        require __DIR__ . '/../../views/index.view.php';
        $content = ob_get_clean();

        $response->setContent($content);
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set("Content-type", "text/html");
        return $response;

    }
}