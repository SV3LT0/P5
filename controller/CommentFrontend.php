<?php

use Model\PostManager;
use Model\CommentManager;
use Model\UserManager;


function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $userManager = new UserManager();

    $users = $userManager->getUser();
    $Sujet = $postManager->getSujet($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/postView.php');
}

function addComment($SujetId, $comment, $idAuteur)
{
    $commentManager = new CommentManager();
    $postManager = new PostManager();    
    $affectedLines = $commentManager->postComment($SujetId, $comment, $idAuteur);
    $majDate = $postManager->updateDate($SujetId);

    if($affectedLines === false){
        throw new Exception('Impossible d\'ajouter le commentaire');
    }
    else{
        header('Location: index.php?action=post&id=' . $SujetId);
    }
}

function deleteComm($id, $SujetId)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->deleteComment($id);

    if($affectedLines === false){
        throw new Exception('Impossible de supprimer le commentaire');
    }
    else{
        header('Location: index.php?action=post&id=' . $SujetId);
    }
}

function reportComm($id, $SujetId)
{
    $commentManager = new CommentManager();
    $commentSignale = $commentManager->signaleCommentaire($id);

    if($commentSignale === false){
        throw new Exception('Impossible de signaler le commentaire');
    }
    else{
        header('Location: index.php?action=post&id=' . $SujetId);
    }
}

function cancelReport($id)
{
    $commentManager = new CommentManager();
    $annuleSignale = $commentManager->annuleSignale($id);

    if($annuleSignale === false){
        throw new Exception('Impossible d\'annuler le signaler');
    }
    else{
        header('Location: index.php?action=tavern');
    }
}