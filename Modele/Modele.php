<?php
/**
 * Gestion de toute les intéractions entre le blog et la base de données
 */

/**
 * Fonction pour retourner tous les articles
 * @return les articles
 */

function getArticles() {
    $bdd = getBdd();
    $articles = $bdd->query('select * from Article order by id_article desc');
    return $articles;
}

/**
 * Fonction pour retourner un article suivant un Id
 * @param type $idArticle
 * @return un article
 * @throws Exception
 */
function getArticle($idArticle) {
    $bdd = getBdd();
    $article = $bdd->query("select * from Article where id_article = $idArticle");
    if ($article->rowCount() == 1) {
        return $article->fetch();
    } else {
        throw new Exception("Aucun article ne correspond à l'identifiant '$idArticle'");
    }
}

/**
 * Fonction pour insérer un commentaire
 * @param type $commentaire
 * @param type $id
 * @return id de l'article retaché au commentaire
 * @throws Exception
 */
function insertCommentaire($commentaire, $id) {
    $bdd = getBdd();
    $test = $bdd->exec("insert into Commentaire (commentaire, id_article) values ('" . htmlspecialchars($commentaire, ENT_QUOTES) . "', $id)");
    if ($test) {
        return $id;
    } else {
        throw new Exception("Erreur BDD -> " . $bdd->errorInfo()[2]);
    }
}

/**
 * Fonction pour mettre à jour un article
 * @param type $article
 * @param type $id
 * @return id de l'article
 * @throws Exception
 */
function updateArticle($article, $id) {
    $bdd = getBdd();
    $test = $bdd->exec("update Article set lib_article = '$article' where id_article = $id");
    if ($test) {
        return $id;
    } else {
        throw new Exception("Erreur BDD  -> " . $bdd->errorInfo()[2]);
    }
}

/**
 * Fonction pour insérer un article
 * @param type $article
 * @return id de l'article
 * @throws Exception
 */
function insertArticle($article) {
    $bdd = getBdd();
    $id = $bdd->query("insert into Article (lib_article) values ('" . htmlspecialchars($article, ENT_QUOTES) . "') returning id_article;");
    if ($id) {
        return $id->fetch();
    } else {
        throw new Exception("Erreur BDD  -> " . $bdd->errorInfo()[2]);
    }
}

/**
 * Fonction pour supprimer un article
 * @param type $id
 * @return id de l'article
 * @throws Exception
 */
function deleteCommentaire($id) {
    $bdd = getBdd();
    $id_art = $bdd->query("select * from Commentaire where id_commentaire = $id");
    $test = $bdd->exec("delete from Commentaire where id_commentaire = $id");
    if ($test) {
        return $id_art->fetch();
    } else {
        throw new Exception("Erreur BDD  -> " . $bdd->errorInfo()[2]);
    }
}
/**
 * Fonction pour supprimer un article
 * @param type $id
 * @return int/bool
 * @throws Exception
 */
function deleteArticle($id) {
    $bdd = getBdd();

    $test = $bdd->exec("delete from Article where id_article = $id");
    if ($test) {
        return 1;
    } else {
        throw new Exception("Erreur BDD  -> " . $bdd->errorInfo()[2]);
    }
}

/**
 * Fonction pour obtenir un utilisateur suivant son pseudo et mdp
 * @param type $pseudo
 * @param type $mdp
 * @return l'utilisateur
 * @throws Exception
 */
function getUser($pseudo, $mdp) {
    $bdd = getBdd();
    $user = $bdd->query("select * from Utilisateur where pseudo_utilisateur = '$pseudo' and mdp_utilisateur = '$mdp'");
    if ($user->rowCount() == 1) {
        return $user->fetch();
    } else {
        throw new Exception("echec de la connexion");
    }
}

/**
 * Fonction pour obtenir tous les commentaires d'un article
 * @param type $idArticle
 * @return les commentaires
 */
function getCommentaires($idArticle) {
    $bdd = getBdd();
    $commentaires = $bdd->query("select * from Commentaire where id_article = $idArticle order by id_commentaire desc");
    return $commentaires;
}

/**
 * Fonction pour obtenir une connexion à la base de données
 * @return \PDO
 * @throws Exception
 */
function getBdd() {
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'admin') {
            $pseudo = 'admin';
            $mdp = 'Admin';
        } elseif ($_SESSION['role'] == 'redacteur') {
            $pseudo = 'redacteur';
            $mdp = 'Redacteur';
        } elseif ($_SESSION['role'] == 'inscrit') {
            $pseudo = 'inscrit';
            $mdp = 'Inscrit';
        }
    } else {
        $pseudo = 'visiteur';
        $mdp = 'Visiteur';
    }
    try {
        $bdd = new PDO('pgsql:host=localhost;dbname=DB_Blog;', $pseudo, $mdp);
        if ($bdd) {
            return $bdd;
        }
    } catch (PDOException $ex) {
        throw new Exception('Erreur BDD -> ' . $ex->getMessage());
    }
}
