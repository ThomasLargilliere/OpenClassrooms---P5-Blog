<?php

if (isset($_GET['action'])){
    $action = $_GET["action"];
} else {
    $action = "home";
}

$is_admin = 0;
$user = 0;
if (isset($_SESSION['user'])){
    $userModel = new \Models\User();
    $is_admin = $userModel->isAdmin();
    $user = $userModel->find($_SESSION['user']);
}

?>

<nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#page-top">Thomas</a>
        <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
        <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="index.php?#header">Accueil</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="index.php?#article">Articles</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="index.php?#about">à propos</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="index.php?#contact">contactez-moi</a></li>
                
                <?php if (!isset($_SESSION['user'])){ ?>

                <li class="nav-item mx-0 mx-lg-1">
                    <a class="nav-link py-3 px-0 px-lg-3 rounded" data-bs-toggle="modal" data-bs-target="#modalConnexion">connexion</a>
                </li>

                <?php } else {  ?>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" data-bs-toggle="modal" data-bs-target="#modalProfil">profil</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="index.php?action=user&task=deconnexion" onclick="return confirm(`Êtes-vous sûr de vouloir vous déconnecter ?`)">déconnexion</a></li>
                <?php } ?>

                <?php if ($is_admin == 1){ ?>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="index.php?action=administration">administration</a></li>
                <?php } ?>

            </ul>
        </div>
    </div>
</nav>

<!-- Modal Connexion -->
<div class="modal fade" id="modalConnexion" tabindex="-1" aria-labelledby="modalConnexionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalConnexionLabel">Connexion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-10 offset-1">
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Connectez-vous</h2>
                    <form method="POST" action="index.php?action=user&task=connect">
                        <div class="form-floating mb-3 mt-3">
                            <input class="form-control" id="email" name="email" type="email" <?php if (isset($_SESSION['email'])){ echo "value=" . $_SESSION['email']; } ?> placeholder="nom@exemple.fr" required />
                            <label class="form-label" for="email">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="password" name="password" type="password" placeholder="Entrer votre mot de passe..." required />
                            <label class="form-label"  for="password">Mot de passe</label>
                        </div>
                        <div>
                            <a data-bs-toggle="modal" data-bs-target="#modalPasswordForget" class="align-bottom">Mot de passe oublié ?</a>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Connexion</button>
                        <a data-bs-toggle="modal" data-bs-target="#modalInscription" class="align-bottom">Pas encore de compte ? Inscrivez-vous</a>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Password forget -->
<div class="modal fade" id="modalPasswordForget" tabindex="-1" aria-labelledby="modalPasswordForgetLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPasswordForgetLabel">Mot de passe oublié</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-10 offset-1">
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Mot de passe oublié</h2>
                    <form method="POST" action="index.php?action=user&task=passwordforget">
                        <div class="form-floating mb-3 mt-3">
                            <input class="form-control" id="email" name="email" type="email" <?php if (isset($_SESSION['email'])){ echo "value=" . $_SESSION['email']; } ?> placeholder="nom@exemple.fr" required />
                            <label class="form-label" for="email">Email</label>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Envoyer le lien de récupération</button>
                        <a data-bs-toggle="modal" data-bs-target="#modalConnexion" class="align-bottom">Connectez-vous</a>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Inscription -->
<div class="modal fade" id="modalInscription" tabindex="-1" aria-labelledby="modalInscriptionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInscriptionLabel">Inscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="col-10 offset-1">
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Inscrivez-vous</h2>
                <form method="POST" action="index.php?action=user&task=register">
                    <div class="form-floating mb-3 mt-3">
                        <input class="form-control" id="email" name="email" type="email" placeholder="nom@exemple.fr" required />
                        <label class="form-label" for="email">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="first_name" name="first_name" type="text" placeholder="Entrer votre prenom..." <?php if (isset($_SESSION['first_name'])){ echo "value=" . $_SESSION['first_name']; } ?> required />
                        <label class="form-label" for="first_name">Prénom</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="name" name="name" type="text" placeholder="Entrer votre nom..." <?php if (isset($_SESSION['name'])){ echo "value=" . $_SESSION['name']; } ?> required />
                        <label class="form-label" for="name">Nom</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="pseudo" name="pseudo" type="text" placeholder="Entrer votre pseudo..." <?php if (isset($_SESSION['pseudo'])){ echo "value=" . $_SESSION['pseudo']; } ?> required />
                        <label class="form-label" for="pseudo">Pseudo</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="password1" name="password1" type="password" placeholder="Entrer un mot de passe..." required />
                        <label class="form-label" for="password1">Mot de passe</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="password2" name="password2" type="password" placeholder="Confirmer votre mot de passe..." required />
                        <label class="form-label" for="password2">Confirmation mot de passe</label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Inscription</button>
                    <a data-bs-toggle="modal" data-bs-target="#modalConnexion" class="align-bottom">Vous avez déjà un compte ? Connectez-vous</a>
                </form>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Profil -->
<div class="modal fade" id="modalProfil" tabindex="-1" aria-labelledby="modalProfilLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalProfilLabel">Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="col-10 offset-1">
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Votre profil</h2>
                <form method="POST" action="index.php?action=user&task=updateProfil" enctype="multipart/form-data">
                    <div class="form-floating mb-3 mt-3">
                        <input type="file" class="form-control" name="image" accept="image/png, image/jpeg">
                    </div>
                    <?php if ($user['image'] != null){ ?>
                        <div style="width:200px;height:200px";>
                            <img style="width:100%;height:auto" src="<?= $user['image']; ?>">
                        </div>
                    <?php } ?>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="email" name="email" type="email" placeholder="nom@exemple.fr" value="<?= $user['email']; ?>" required />
                        <label class="form-label" for="email">Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="first_name" name="first_name" type="text" placeholder="Entrer votre prenom..." value="<?= $user['first_name']; ?>" required />
                        <label class="form-label" for="first_name">Prénom</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="name" name="name" type="text" placeholder="Entrer votre nom..." value="<?= $user['name']; ?>" required />
                        <label class="form-label" for="name">Nom</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="pseudo" name="pseudo" type="text" placeholder="Entrer votre pseudo..." value="<?= $user['pseudo']; ?>" required />
                        <label class="form-label" for="pseudo">Pseudo</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="old_password" name="old_password" type="password" placeholder="Ancien mot de passe..." required />
                        <label class="form-label" for="old_password">Ancien mot de passe</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="new_password1" name="new_password1" type="password" placeholder="Nouveau mot de passe..." />
                        <label class="form-label" for="new_password1">Nouveau mot de passe</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="new_password2" name="new_password2" type="password" placeholder="Confirmer votre nouveau mot de passe..." />
                        <label class="form-label" for="new_password2">Confirmation nouveau mot de passe</label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
                </form>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>