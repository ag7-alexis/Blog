<?php
/**
 * Contenu d'un article
 */
?>

<?php $titre = 'Un Article'; ?>

<?php
if (isset($id_article)) {
    $id = $id_article;
} else {
    $id = $_GET['id'];
}

ob_start();
?>

<div class="card" style="width: 44rem;">
    <div class="card-header">
        <h2>Un article</h2>
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <form method="post" action="?action=modifArticle&amp;id=<?= $id ?>">
                    <input type="hidden" name="modif" id="modif" value="1" >
                    <input type="hidden" name="id" id="id" value="<?= $id ?>" >
                    <textarea name="article" class="form-control"><?= $article[1] ?></textarea>
                    <input class="btn btn-success" type="submit" value="Modifier" >
                    <a class="btn btn-danger" href="?action=suppArticle&amp;id=<?= $id ?>">Supprimer</a>
                </form>
            </li>
            <li class="list-group-item">
                <form method="post" action="?action=attempComment&amp;id=<?= $id ?>">
                    <input type="hidden" name="commenter" id="commenter" value="1" >
                    <input type="hidden" name="id" id="id" value="<?= $id ?>" >
                    <label for="commentaire">Laisser un commentaire</label>
                    <textarea class="form-control" required id="commentaire" name="commentaire"></textarea>
                    <input class="btn btn-primary" type="submit" value="Commenter" >
                </form>
            </li>
            <?php
            foreach ($commentaires as $commentaire):
            ?>
                <li class="list-group-item"><p><?= $commentaire[1] ?></p><a href="?action=supComment&amp;id_comm=<?= $commentaire[0] ?>">Supprimer le commentaire</a></li>
            <?php 
            endforeach; 
            ?>
        </ul>
    </div>
</div>

<?php $contenu = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>
