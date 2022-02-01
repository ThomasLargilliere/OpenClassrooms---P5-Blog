<?php ob_start(); ?>

<div class="col-10 offset-1 content-height">
    <div class="text-center mt-3">
        <a class="btn btn-primary btn-lg" href="index.php?action=administration&task=writeArticle">Ecrire un article</a>
    </div>

    <h1 class="mt-5 mb-5">Liste des articles</h1>
    <table class="table">
        <tbody>
            <?php foreach ($articles as $article){ ?>
            <tr>
                <th scope="row"><?= $article['title'] ?></th>
                <td>Ecris le : <?= $article['created_at'] ?></td>
                <td>Modifié le : <?php if ($article['updated_at']){ echo $article['updated_at']; } else { echo "Jamais"; } ?></td>
                <td><a class="btn btn-warning" href="index.php?action=administration&task=updateArticle&id=<?=$article['id'];?>">Modifier</a></td>
                <td><a class="btn btn-danger" href="index.php?action=article&task=delete&id=<?=$article['id'];?>" onclick="return confirm(`Êtes-vous sûr de vouloir supprimer cet article ?`)">Supprimer</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>