<?php   
    require_once '../vendor/autoload.php';
    require_once '../framework/autoload.php';
    require_once "../controllers/Controller404.php"; 
    require_once "../controllers/MainController.php";
    require_once "../controllers/ObjectController.php";

    $loader = new \Twig\Loader\FilesystemLoader('../views');
    $twig = new \Twig\Environment($loader, [
        "debug" => true
    ]);
    $twig->addExtension(new \Twig\Extension\DebugExtension());

    $pdo = new PDO("mysql:host=localhost;dbname=modern_art;charset=utf8", "root", "");

    $router = new Router($twig, $pdo);
    $router->add("/", MainController::class);
    $router->add("/art_objects/(?P<id>\d+)", ObjectController::class);

    $router->get_or_default(Controller404::class);
?>