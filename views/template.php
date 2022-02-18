<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $pageTitle ?> | Thomas Largilliere</title>
        <link href="public/css/normalize.css" rel="stylesheet" /> 
        <link href="public/css/style.css" rel="stylesheet" />
        <link href="public/theme_freelancer/css/styles.css" rel="stylesheet" />

        <link rel="icon" type="image/x-icon" href="public/favicon.ico" />
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body id="page-top">
        <?php require('views/navbar.php'); ?>
        <?php require('views/alert.php'); ?>
        <?php echo $content ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="public/theme_freelancer/js/scripts.js"></script>
    </body>
</html>