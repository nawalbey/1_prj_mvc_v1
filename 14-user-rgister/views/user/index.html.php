<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <th>ID</th>
        <th>Niveau</th>
        <th>Pseudo</th>
        <th>Mot de passe</th>
        <th>Identité</th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td>
                    <?= $user->getId() ?>
                </td>

                <td>
                    <?php
                    switch ($user->getNiveau()):
                        case ROLE_ADMIN:
                            echo "Administrateur";
                            break;
                        case ROLE_USER:
                            echo "user";
                            break;
                    endswitch;
                    ?>
                </td>

                <td>
                    <?= $user->getPseudo() ?>
                </td>

                <td>
                    <?= $user->getMdp() ? "****" : "" ?>
                </td>

                <td>
                    <?= $user->getPrenom() . " " . $user->getNom() ?>
                </td>

                <td>
                    <a href="<?= addLink("user", "update", $user->getId()) ?>" class="btn btn-secondary">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="<?= addLink("user", "supprimer", $user->getId()) ?>" class="btn btn-secondary">
                        <i class="fa fa-trash"></i>
                    </a>
                    <a href="<?= addLink("user", "fiche", $user->getId()) ?>" class="btn btn-secondary">
                        <i class="fa fa-eye"></i>
                    </a>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>