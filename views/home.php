<?php ob_start(); ?>

<header id="header" class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <img class="masthead-avatar mb-5" src="public/theme_freelancer/assets/img/avataaars.svg" alt="..." />
        <h1 class="masthead-heading text-uppercase mb-0">Thomas Largillière</h1>
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <p class="masthead-subheading font-weight-light mb-0">Thomas Largillière, le développeur qu'il vous faut !</p>
        <p><a class="text-white" target="_BLANK" href="public/images/cv-thomas.pdf">Mon CV</a></p>
    </div>
</header>
<section class="page-section portfolio" id="article">
    <div class="container">
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Articles</h2>
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <div class="row justify-content-center text-center">
            <?php foreach ($articles as $article){ ?>
            <div class="col-md-6 col-lg-4 mb-5">
                <p class="font-weight-bold text-uppercase"><?=$article['title']; ?></p>
                <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal1">
                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="text-center text-white">
                            <div class="portfolio-chapo">
                                <?= $article['chapo']; ?>
                            </div>
                            <div class="div-link-portfolio">
                                <a class="link-portfolio" href="index.php?action=article&task=read&id=<?=$article['id']?>">Lire en entier</a>
                            </div>
                        </div>
                    </div>
                    <img style="height:250px;" class="img-fluid" src="<?=$article['image']?>" alt="Image article" />
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<section class="page-section bg-primary text-white mb-0" id="about">
    <div class="container">
        <h2 class="page-section-heading text-center text-uppercase text-white">à propos</h2>
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <div class="row">
            <div class="col-lg-4 ms-auto">
                <p class="lead">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>
            <div class="col-lg-4 me-auto">
                <p class="lead">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>
        </div>
    </div>
</section>
<section class="page-section" id="contact">
    <div class="container">
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Contactez-moi</h2>
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <form id="contactForm" method="POST" action="index.php?action=mailer&task=send">
                    <div class="form-floating mb-4">
                        <input class="form-control" id="first_name" name="first_name" type="text" placeholder="Entrer votre prénom..." required />
                        <label class="form-label" for="first_name">Prénom</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input class="form-control" id="name" name="name" type="text" placeholder="Entrer votre nom..." required />
                        <label class="form-label" for="name">Nom</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input class="form-control" id="email" name="email" type="email" placeholder="nom@exemple.fr" required />
                        <label class="form-label" for="email">Email</label>
                    </div>
                    <div class="form-floating mb-4">
                        <textarea class="form-control" id="message" name="content" type="text" placeholder="Entrer votre message ici..." style="height: 10rem" required></textarea>
                        <label class="form-label" for="message">Message</label>
                    </div>
                    <button class="btn btn-primary btn-xl" id="submitButton" type="submit">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</section>
<footer class="footer text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Adresse</h4>
                <p class="lead mb-0">
                    2 Allée des anémones
                    <br />
                    Bondy, 93140
                </p>
            </div>
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Réseaux sociaux</h4>
                <a target="_BLANK" href="https://github.com/ThomasLargilliere" class="btn btn-outline-light mx-2">
                    <i class="fab fa-fw fa-github"></i>
                </a>
                <a target="_BLANK" href="https://www.youtube.com/channel/UCkZI_PyjSVHnEUvgiXkLlww" class="btn btn-outline-light mx-2">
                    <i class="fab fa-fw fa-youtube"></i>
                </a>
                <a target="_BLANK" href="https://www.linkedin.com/in/thomas-largilliere-368055230/" class="btn btn-outline-light mx-2">
                    <i class="fab fa-fw fa-linkedin-in"></i>
                </a>
            </div>
        </div>
    </div>
</footer>
<div class="copyright py-4 text-center text-white">
    <div class="container"><small>Copyright - &copy; Thomas Largillière</small></div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>