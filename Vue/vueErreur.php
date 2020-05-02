<?php
/**
 * Contenu pour les erreurs
 */
?>

<?php $titre = 'Erreur'; ?>

<?php ob_start() ?>

<div class="card text-white bg-warning" style="width: 44rem;">
    <div class="card-header">
        <h2>Erreur</h2>
    </div>
    <div class="card-body">
        <p>Une erreur est survenue : <?= $msgErreur ?></p>
    </div>
</div>

<?php $contenu = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>