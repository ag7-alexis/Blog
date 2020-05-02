<?php

/**
 * Controle les actions sur la base de données et l'affichage
 */

session_start();

require 'Modele/Modele.php';

/**
 * Récupère la liste des articles et affiche la page d'accueil
 */
function accueil() {
    $articles = getArticles();
    require 'Vue/vueAccueil.php';
}

/**
 * Affiche la page de connexion
 */
function connexion() {
    require 'Vue/vueConnexion.php';
}

/**
 * Récupère un article et ses commentaires avec un Id et affiche la page de l'article
 * @param type $id_article
 */
function unArticle($id_article) {
    $article = getArticle($id_article);
    $commentaires = getCommentaires($id_article);
    require 'Vue/vueArticle.php';
}

/**
 * Verifie si le pseudo et le mdp renseigné correspond à un utilisateur, puis génère les variables de sessions et renvoi vers la page d'accueil
 * @param type $pseudo
 * @param type $mdp
 */
function essaieConnexion($pseudo, $mdp) {
    $user = getUser($pseudo, $mdp);
    if (isset($user)) {
        $_SESSION['role'] = $user[3];
        $_SESSION['pseudo'] = $user[1];
        echo "<p class='btn-success alert-t'>connexion réussite</p>";
        accueil();
    }
}

/**
 * Affiche la page de création d'article
 */
function newArticle() {
    require 'Vue/vueNewArticle.php';
}

/**
 * Créer un article et renvoi vers la page de cet article
 * @param type $article
 */
function creatArticle($article) {
    $id = insertArticle($article);
    if (isset($id)) {
        echo "<p class='btn-success alert-t'>article créé</p>";
        $id_article = $id[0];
        unArticle($id_article);
    }
}

/**
 * Supprime un commentaire et renvoi vers l'article d'ou proviens le commentaire
 * @param type $id_comm
 */
function suppCommentaire($id_comm) {
    $comm = deleteCommentaire($id_comm);
    if (isset($comm)) {
        echo "<p class='btn-success alert-t'>commentaire supprimé</p>";
        $id_article = $comm[2];
        unArticle($id_article);
    }
}

/**
 * Supprime les variables de sessions et renvoi vers la page d'accueil
 */
function deconnexion() {
    $test = session_destroy();
    if (isset($test)) {
        header ('location: index.php');
    }
}

/**
 * Supprime un article et renvoi vers la page d'accueil
 * @param type $id
 */
function suppArticle($id) {
    $art = deleteArticle($id);
    if (isset($art)) {
        echo "<p class='btn-success alert-t'>article supprimé</p>";
        accueil();
    }
}

/**
 * Modifie un article et renvoi vers la page de l'article
 * @param type $art
 * @param type $id
 */
function modifArticle($art, $id) {
    $art = updateArticle($art, $id);
    if (isset($art)) {
        echo "<p class='btn-success alert-t'>article modifié</p>";
        $id_article = $art;
        unArticle($id_article);
    }
}

/**
 * Créer un nouveau commentaire et renvoi vers la page de l'article d'ou proviens le commentaire
 * @param type $commentaire
 * @param type $id
 */
function newCommentaire($commentaire, $id) {
    $newComment = insertCommentaire($commentaire, $id);
    if (isset($newComment)) {
        echo "<p class='btn-success alert-t'>commentaire ajouté</p>";
        $id_article = $newComment;
        unArticle($newComment);
    }
}

/**
 * Affiche le message d'erreur
 * @param type $msgErreur
 */
function erreur($msgErreur) {
    require 'Vue/vueErreur.php';
}
