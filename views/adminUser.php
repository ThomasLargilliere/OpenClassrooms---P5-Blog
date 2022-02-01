<?php ob_start(); ?>

<div class="col-10 offset-1 content-height">
    <h1 class="mt-5 mb-5">Liste des utilisateurs</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Email</th>
                <th scope="col">Pseudo</th>
                <th scope="col">Prénom</th>
                <th scope="col">Nom</th>
                <th scope="col">Role</th>
                <th scope="col">Modifier</th>
                <th scope="col">Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user){ ?>
            <tr>
                <th scope="row"><?= $user['email']; ?></th>
                <td><?= $user['pseudo']; ?></td>
                <td><?= $user['first_name']; ?></td>
                <td><?= $user['name']; ?></td>
                <td><?= $user['label']; ?></td>
                <td><a class="btn btn-warning" href="index.php?action=administration&task=updateUser&id=<?=$user['id_user'];?>">Modifier</a></td>
                <td><a class="btn btn-danger" href="index.php?action=user&task=delete&id=<?=$user['id_user'];?>" onclick="return confirm(`Êtes-vous sûr de vouloir supprimer cet utilisateur ?`)">Supprimer</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>