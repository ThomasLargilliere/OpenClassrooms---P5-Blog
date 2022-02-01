<?php ob_start(); ?>

<div class="col-lg-6 offset-lg-3 col-10 offset-1 content-height">
    <h1>Modifier un article</h1>
    <form method="POST" action="index.php?action=article&task=update&id=<?= $article['id']; ?>">
        <div class="form-group mt-3">
            <input type="text" class="form-control" name="title" value="<?= $article['title']; ?>">
        </div>
        <div class="form-group mt-3">
            <textarea class="form-control" rows="4" name="chapo" placeholder="Description de votre article (255 caractères max)" maxlength="255">
                <?= $article['chapo']; ?>
            </textarea>
        </div>
        <div class="form-group mt-3">
            <textarea class="form-control" rows="20" name="content" placeholder="Contenu de votre article">
                <?= $article['content']; ?>
            </textarea>
        </div>
        <button type="submit" class="btn btn-warning mt-3">Modifier</button>
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>