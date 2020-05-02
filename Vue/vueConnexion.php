<?php
/**
 * Contenu de la page de connexion
 */
?>

<?php $titre = 'Connexion'; ?>

<?php ob_start(); ?>

<div class="card" style="width: 22rem;">
    <div class="card-header">
        <h2>Connexion</h2>
    </div>
    <div class="card-body">
        <form method="post" action="?action=attempConnex">
            <input type="hidden" name="connexion" id="connexion" value="1" >
            <label for="pseudo">pseudo</label>
            <input class="form-control" type="text" id="pseudo" name="pseudo" required>
            <label for="mdp">mots de passe</label>
            <input class="form-control" type="password" id="mdp" name="mdp" required>
            <input class="btn btn-primary" type="submit" value="Se connecter" >

        </form>
    </div>
</div>

<?php $contenu = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>