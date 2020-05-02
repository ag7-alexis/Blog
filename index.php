<?php

/**
 * Gestionnaire des différentes actions du blog
 */

require 'Controleur/Controleur.php';

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'connexion') {
            connexion();
        } elseif ($_GET['action'] == 'unArticle') {
            if (isset($_GET['id'])) {
                unArticle($_GET['id']);
            } else
                throw new Exception("Identifiant de l article necessaire");
        }elseif ($_GET['action'] == 'attempConnex') {
            if (isset($_POST['connexion'])) {
                essaieConnexion($_POST['pseudo'], $_POST['mdp']);
            } else
                throw new Exception("Tentative de connexion invalide");
        }elseif ($_GET['action'] == 'attempComment') {
            if (isset($_POST['commenter'])) {
                newCommentaire($_POST['commentaire'], $_POST['id']);
            } else
                throw new Exception("Tentative d'envoi d'un commentaire invalide");
        }elseif ($_GET['action'] == 'supComment') {
            if (isset($_GET['id_comm'])) {
                suppCommentaire($_GET['id_comm']);
            }
        } elseif ($_GET['action'] == 'modifArticle') {
            if (isset($_POST['modif'])) {
                modifArticle($_POST['article'], $_POST['id']);
            }
        } elseif ($_GET['action'] == 'newArticle') {
            newArticle();
        } elseif ($_GET['action'] == 'creatArticle') {
            if (isset($_POST['newArt'])) {
                creatArticle($_POST['article']);
            }
        } elseif ($_GET['action'] == 'suppArticle') {
            if (isset($_GET['id'])) {
                suppArticle($_GET['id']);
            }
        }elseif ($_GET['action'] == 'deconnexion') {
            deconnexion();
        }
        
        else
            throw new Exception("Action non valide");
    }
    else {
        accueil();
    }
} catch (Exception $e) {
    erreur($e->getMessage());
}