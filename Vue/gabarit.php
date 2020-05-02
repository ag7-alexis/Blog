<?php
/**
 * Contenu commun à toutes les pages
 */
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="Contenu/style.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <title><?= $titre ?></title>
    </head>
    <body>
        <div id="global">
            <nav class="navbar navbar-dark bg-primary d-flex">
                <a class="navbar-brand p-2" href="/index.php">GUAY Alexis</a>

                <a class="nav-link p-2" href="/index.php">Accueil</a>

                <a class="nav-link p-2" href="?action=newArticle">Rédiger un article</a>

                <?php
                if (!isset($_SESSION['pseudo'])) {
                    echo '<a class="nav-link ml-auto p-2" href="?action=connexion">Connexion</a>';
                } else {
                    echo "<div class=' ml-auto '><p class='nav-link p-2 ext'>" . $_SESSION['pseudo'] . " est un " . $_SESSION['role'] . "</p>";
                    echo '<a class="nav-link p-2 ext" href="?action=deconnexion">Déconnexion</a></div>';
                }
                ?>
            </nav>
            <div id="contenu">
                <?= $contenu ?>
            </div> 
        </div> 
    </body>
</html>