Pour utiliser ce projet, suivez les instructions ci-dessous :

- Télécharger le projet
- Extraire le projet dans un dossier nommé "blog" sur un serveur apache tel que XAMPP.
- Rendez-vous sur PhpMyAdmin, créer une base de donnée (nommé la comme vous la souhaitez)
- Cliquer sur la base de donnée que vous venez de créer et aller dans l'onglet "Importer"
- Cliquer sur le bouton "Choisir un fichier" et choisissez le fichier "blog.sql" qui est dans le dossier "blog" sur votre serveur apache
- Une fois tout cela fait, ouvrez le fichier "env.php" et remplissez les données demandées

Pour la prochaine étape vous devez avoir installer composer
(si vous ne l'avez pas d'installer : https://getcomposer.org/download/)

Une fois composer installer, lancer visual studio code, ouvrez le dossier "blog" et ouvrer un terminal, ecrivez ceci dans le terminal :
composer require phpmailer/phpmailer

C'est fini !

Pour vous connecter, rendez-vous sur un lien qui devrait ressembler à celui-ci :

localhost/blog

une fois sur la page cliquer sur "connexion" puis entrez les informations suivantes :
- Email : admin@admin.com
- Mot de passe : admin
