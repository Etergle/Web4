<?php
require_once "BaseArtTwigController.php"; // импортим TwigBaseController

class MainController extends BaseArtTwigController {
    public $template = "main.twig";
    public $title = "Главная";

    public function getContext(): array
    {
        $context = parent::getContext();
        
        if (isset($_GET['type'])) {
            $query = $this->pdo->prepare("SELECT * FROM art_objects WHERE type = :type");
            $query->bindValue("type", $_GET['type']);
            $query->execute();
        } else {
            $query = $this->pdo->query("SELECT * FROM art_objects");
        }

        $context['art_objects'] = $query->fetchAll();
        
        return $context;
    }
}