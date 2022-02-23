Pour utiliser ce projet, suivez les instructions ci-dessous :

- Télécharger le projet
- Extraire le projet dans un dossier nommé "blog" sur un serveur apache tel que XAMPP.
- Rendez-vous sur PhpMyAdmin, créer une base de donnée (nommé la comme vous la souhaitez)
- Cliquer sur la base de donnée que vous venez de créer et aller dans l'onglet "Importer"
- Cliquer sur le bouton "Choisir un fichier" et choisissez le fichier "blog.sql" qui est dans le dossier "blog" sur votre serveur apache
- Une fois tout cela fait, ouvrez le fichier "env.php" et remplissez les données demandées

Pour le fichier env :
- host_bdd = le nom d'hôte de la base de donnée, en général "localhost"
- name_bdd = le nom que vous avez choisis à l'étape 3 de la base de donnée
- user_bdd = le nom d'utilisateur pour accéder à la base de donnée
- password_bdd = le mot de passe pour accéder à la base de donnée
- your_email = l'email qui sera utilisé pour l'envoie de mail (formulaire de contact, mot de passe oublié)
- your_password = le mot de passe de votre email
- your_name = votre nom et prenom ou le nom que vous souhaitez qui soit afficher lors de l'envoie d'un mail pour un mot de passe oublié

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
