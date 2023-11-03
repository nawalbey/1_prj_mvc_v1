<?php
require "inc/init.inc.php";

/* 
URL: index.php?controller=user&methode=update&id=32
*/
$controller = $_GET["controller"] ?? "accueil";
$methode    = $_GET["methode"] ?? "liste";
$id         = $_GET["id"] ?? null;

$classeController = "Controllers\\" . ucfirst($controller) . "Controller";  // ucfirst: met la première lettre d'un string en majuscule
/* $classeController = "Controllers\UserController" 
   $methode = "liste"
*/

// echo $controller . "<br>";
// echo $method . "<br>";
// echo $id . "<br>";

/* On peut instancier un objet en utilisant un string pour le nom de la classe.
    _⚠ le nom de la classe doit être dans une variable pour pouvoir utiliser 'new'
*/
$controller = new $classeController;
// $UserController->update($id);
$controller->$methode($id);
