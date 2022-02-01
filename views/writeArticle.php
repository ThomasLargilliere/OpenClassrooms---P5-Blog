<?php ob_start(); ?>

<div class="col-lg-6 offset-lg-3 col-10 offset-1 content-height">
    <h1>Ecrire un article</h1>
    <form method="POST" action="index.php?action=article&task=write">
        <div class="form-group mt-3">
            <input type="text" class="form-control" name="title" placeholder="Titre de votre article">
        </div>
        <div class="form-group mt-3">
            <textarea class="form-control" rows="4" name="chapo" placeholder="Description de votre article (255 caractères max)" maxlength="255"></textarea>
        </div>
        <div class="form-group mt-3">
            <textarea class="form-control" rows="20" name="content" placeholder="Contenu de votre article"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Créer</button>
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>