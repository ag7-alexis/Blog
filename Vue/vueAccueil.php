<?php
/**
 * Contenu de l'accueil
 */
?>

<?php $titre = 'Accueil'; ?>

<?php ob_start(); ?>

<h1>Accueil</h1>

<div class="card">
    <div class="card-header">
        <h2>Les articles</h2>
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <?php
            foreach ($articles as $article):
            ?>
                <li class="list-group-item"><p><?= $article[1] ?></p><a href="?action=unArticle&amp;id=<?= $article[0] ?>">Consulter</a></li>
            <?php
            endforeach;
            ?>
        </ul>
    </div>
</div>

<?php $contenu = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>