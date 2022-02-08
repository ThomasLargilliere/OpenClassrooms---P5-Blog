<?php ob_start(); ?>

<div class="col-lg-8 offset-lg-2 content-height">
	<h1 class="text-center display-2">Nouveau mot de passe</h1>
	<div class="col-10 offset-1 p-1 mt-2">
        <form method="POST" action="index.php?action=user&task=changepassword&token=<?=$_GET['token']; ?>">
            <div class="form-floating mb-3 mt-3">
                <input class="form-control" id="password" name="password" type="password" placeholder="**************" required />
                <label class="form-label" for="password">Mot de passe</label>
            </div>
            <div class="form-floating mb-3 mt-3">
                <input class="form-control" id="confirmPassword" name="confirmPassword" type="password" placeholder="**************" required />
                <label class="form-label" for="confirmPassword">Confirmer mot de passe</label>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Changer de mot de passe</button>
        </form>
	</div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>