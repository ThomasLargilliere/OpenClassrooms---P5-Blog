<?php ob_start(); ?>

<div class="col-lg-8 offset-lg-2 content-height">
	<h1 class="text-center display-2"><?= $article['title']; ?></h1>
	<div class="col-10 offset-1 p-1 mt-2">
		<?php if ($article['updated_at'] == null){ ?>
			<p>Ecris le : <?= $article['created_at']; ?></p>
		<?php } else { ?> 
			<p>Modifié le : <?= $article['updated_at']; ?></p>
		<?php } ?>
		<p class="text-justify"><?= $article['chapo']; ?></p>
		
		<p class="text-justify">
			<?php echo nl2br($article['content']); ?>
		</p>
		<p>Ecris par : <?= $author ?></p>

		<a href="index.php?#article">Retour</a>
	</div>

	<h2 class="text-center display-5">Commentaires</h2>
	<div class="col-10 offset-1">
		<?php if (isset($_SESSION['user'])){ ?>
			<form method="POST" action="index.php?action=comment&task=insert">
				<div class="form-group mt-3">
					<textarea class="form-control" rows="5" name="content" placeholder="Votre commentaire ici"></textarea>
				</div>
				<input type="hidden" name="id_article" value="<?= $article['id']; ?>">
				<button type="submit" class="btn btn-primary mt-3">Envoyer</button>
			</form>
		<?php } else { ?>
			<a data-bs-toggle="modal" data-bs-target="#modalConnexion" href="">Connectez-vous pour laisser un commentaire !</a>
		<?php } ?>
	</div>

	<div class="col-10 offset-1">
		<?php foreach ($commentaires as $commentaire){ ?>
		<div class="col-12 p-1 mt-3">
			<p>Ecris le : <?= $commentaire['formated_created_at']; ?> par <?= $commentaire['pseudo']; ?></p>
			<p class="text-justify"><?=$commentaire['content']; ?></p>
			
			<?php
				if ((isset($_SESSION['user']) && ($_SESSION['user'] == $commentaire['id_user'] || $is_admin == 1) )){ 
			?>
				<a href="index.php?action=comment&task=delete&id=<?=$commentaire['id_comment'];?>&id_article=<?= $article['id']; ?>" onclick="return confirm(`Êtes-vous sûr de vouloir supprimer ce commentaire ?`)" class="btn btn-danger mb-3">Supprimer</a>
			<?php } ?>
		
		
		</div>
		<?php } ?>
	</div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>