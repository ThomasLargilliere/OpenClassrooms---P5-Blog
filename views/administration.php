<?php ob_start(); ?>

<div class="text-center content-height">
    <a href="index.php?action=administration&task=article" class="btn btn-primary">Gestion des articles</a>
    <a href="index.php?action=administration&task=valid" class="btn btn-primary">Gestion des commentaires</a>
    <a href="index.php?action=administration&task=user" class="btn btn-primary">Gestion des utilisateurs</a>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>