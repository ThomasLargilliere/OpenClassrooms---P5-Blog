<?php ob_start(); ?>

<div class="col-lg-6 offset-lg-3 col-10 offset-1 content-height">
    <h1>Validation des commentaires</h1>


    <div class="col-12">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Commentaire</th>
                    <th scope="col">Auteur</th>
                    <th scope="col">Valider</th>
                    <th scope="col">Refuser</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($commentaires as $commentaire){ ?>
                <tr>
                    <th scope="row"><?= $commentaire['formated_created_at']; ?></th>
                    <td style="max-width:200px;overflow-x:scroll;"><?= $commentaire['content']; ?></td>
                    <td><?= $commentaire['pseudo']; ?></td>
                    <td><a href="index.php?action=comment&task=valid&id=<?= $commentaire['id_comment']; ?>" class="btn btn-success mb-3">Valider</a></td>
                    <td><a href="index.php?action=comment&task=refuse&id=<?= $commentaire['id_comment']; ?>" class="btn btn-danger mb-3">Refuser</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>