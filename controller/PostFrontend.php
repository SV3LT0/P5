<?php

use Model\PostManager;
use Model\CommentManager; 

function pageUpdate()
{
    $postManager = new PostManager();

    $Sujet = $postManager->getSujet($_GET['id']);
  
    require('view/updateSujet.php');
}

function supprimerSujet($idSujet)
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $deleteSujet = $postManager->deletSujet($idSujet);
    $deleteCommEp = $commentManager-> deleteCommEp($idSujet);

    header('Location: index.php?action=tavern');
}

function updateSujet($titre, $contenu, $id, $numeroChapitre)
{
    $postManager = new PostManager();
    $updateSujet = $postManager->modifierSujet($titre, $contenu, $id, $numeroChapitre);

    if($updateSujet === false){
        throw new Exception ('Impossible de modifier l\'épisode');
    }
    else{
        header('Location: index.php');
    }
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
