<?php

use Model\PostManager;
use Model\CommentManager; 

function supprimerSujet($idSujet)
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $deleteSujet = $postManager->deletSujet($idSujet);
    $deleteCommEp = $commentManager-> deleteCommEp($idSujet);

    header('Location: index.php?action=tavern');
}

function pageNewSujet()
{
    require('view/newSujet.php');
}

function addNewSujet($titre, $contenu, $idPseudo, $auteur)
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $nouveauSujet = $postManager->newSujet($titre, $auteur);
    $getSujet = $postManager->getSujetByTitle($titre);
    $addContenu = $commentManager->postComment($getSujet['id'], $contenu, $idPseudo);

    if ($nouveauSujet === false){
        throw new Exception ('Impossible d\'ajouter le sujet');
    }
    else{
        header('Location: index.php?action=tavern');
    }
}
