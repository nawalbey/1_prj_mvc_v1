<?php
$mode = $mode ?? "insertion";
require "views/errors_form.html.php";
?>

<form method="post">
    <div class="form-group">
        <label for="pseudo">Pseudo <sup>*</sup></label>
        <input type="text" name="pseudo" id="pseudo" class="form-control" value="<?= $user->getPseudo() ?>" <?= $mode == "suppression" ? "disabled" : "" ?>>
    </div>

    <div class="form-group">
        <label for="mdp">Mot de passe <sup>*</sup></label>
        <input type="text" name="mdp" id="mdp" class="form-control" <?= $mode == "suppression" ? "disabled" : "" ?>>
    </div>

    <div class="form-group">
        <label for="nom">nom</label>
        <input type="text" name="nom" id="nom" class="form-control" value="<?= $user->getNom() ?>" <?= $mode == "suppression" ? "disabled" : "" ?>>
    </div>

    <div class="form-group">
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" class="form-control" value="<?= $user->getPrenom() ?>" <?= $mode == "suppression" ? "disabled" : "" ?>>
    </div>

    <div class="form-group">
        <label for="niveau">Niveau</label>
        <input type="text" name="niveau" id="niveau" class="form-control" value="<?= $user->getNiveau() ?>" <?= $mode == "suppression" ? "disabled" : "" ?>>
    </div>

    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary" name="submit">
            <?= $mode == "suppression" ? "Confirmer" : "Enregistrer" ?>
        </button>
        <a href="<?= addLink("user") ?>" class="btn btn-danger">Annuler</a>
    </div>
</form>