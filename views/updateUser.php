<?php ob_start(); ?>

<div class="col-lg-6 offset-lg-3 col-10 offset-1 content-height">
    <h1>Modifier un utilisateur</h1>
    <form method="POST" action="index.php?action=user&task=update&id=<?= $user['id']; ?>">
        <div class="form-group mt-3">
            <input type="email" class="form-control" name="email" value="<?= $user['email']; ?>">
        </div>
        <div class="form-group mt-3">
            <input type="text" class="form-control" name="pseudo" value="<?= $user['pseudo']; ?>">
        </div>
        <div class="form-group mt-3">
            <input type="text" class="form-control" name="first_name" value="<?= $user['first_name']; ?>">
        </div>
        <div class="form-group mt-3">
            <input type="text" class="form-control" name="name" value="<?= $user['name']; ?>">
        </div>
        <div class="form-group mt-3">
            <select class="form-control" name="role">
                <?php foreach ($roles as $role){ ?>
                    <option value='<?php echo $role['id']; ?>' <?php if($role['id'] == $user['id_role']){ echo 'selected'; } ?> ><?= $role['label']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group mt-3">
            <input type="text" class="form-control" name="password" placeholder="Laisser vide pour ne pas modifier">
        </div>
        <button type="submit" class="btn btn-warning mt-3">Modifier</button>
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>