<?php
require "inc/init.inc.php";

/* 
URL: index.php?controller=user&method=update&id=32
*/
$controller = $_GET["controller"] ?? "home";
$method    = $_GET["method"] ?? "liste";
$id         = $_GET["id"] ?? null;

$classController = "Controller\\" . ucfirst($controller) . "Controller";  // ucfirst: met la première lettre d'un string en majuscule
/* $classController = "Controller\UserController" 
   $method = "liste"
*/

/* On peut instancier un objet en utilisant un string pour le nom de la class.
    _⚠ le nom de la class doit être dans une variable pour pouvoir utiliser 'new'
*/

try {
    $controller = new $classController;
    // $UserController->update($id);

    $controller->$method($id);
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}