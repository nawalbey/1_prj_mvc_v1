<?php


/* 
URL: index.php?controller=user&method=update&id=32
*/
$controller = $_GET["controller"] ?? "home";
$method    = $_GET["method"] ?? "liste";
$id         = $_GET["id"] ?? null;

echo $controller."<br>";
echo $method."<br>";
echo $id."<br>";