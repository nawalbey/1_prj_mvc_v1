<?php

require "../inc/init.inc.php";
$h1 = "ERREUR 403 : Accès refusé";
include "../views/header.html.php";
?>

<h2>⛔ Vous n'avez pas accès à cet URL</h2>

<a href="/" class="btn btn-primary">
    <i class="fa fa-home"></i> Retourner à la page d'accueil
</a>

<?php
include "../views/footer.html.php";