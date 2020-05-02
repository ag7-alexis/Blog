<?php
/**
 * Contenu pour la rédaction d'un article
 */
?>

<?php $titre = 'Rédiger Un Article'; ?>

<?php ob_start(); ?>

<div class="card" style="width: 44rem;">
    <div class="card-header">
        <h2>Un nouvel article</h2>
    </div>
    <div class="card-body">
        <form method="post" action="?action=creatArticle">
            <input type="hidden" name="newArt" id="modif" value="1" >
            <textarea name="article" required class="form-control"></textarea>
            <input class="btn btn-primary" type="submit" value="Créer" >
        </form>
    </div>
</div>

<?php $contenu = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>
