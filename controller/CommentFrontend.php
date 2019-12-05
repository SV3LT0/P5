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
    $episode = $postManager->getEpisode($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/postView.php');
}

function addComment($episodeId, $comment, $idAuteur)
{
    $commentManager = new CommentManager();    
    $affectedLines = $commentManager->postComment($episodeId, $comment, $idAuteur);

    if($affectedLines === false){
        throw new Exception('Impossible d\'ajouter le commentaire');
    }
    else{
        header('Location: index.php?action=post&id=' . $episodeId);
    }
}

function deleteComm($id, $episodeId)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->deleteComment($id);

    if($affectedLines === false){
        throw new Exception('Impossible de supprimer le commentaire');
    }
    else{
        header('Location: index.php?action=post&id=' . $episodeId);
    }
}

function reportComm($id, $episodeId)
{
    $commentManager = new CommentManager();
    $commentSignale = $commentManager->signaleCommentaire($id);

    if($commentSignale === false){
        throw new Exception('Impossible de signaler le commentaire');
    }
    else{
        header('Location: index.php?action=post&id=' . $episodeId);
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
        header('Location: index.php');
    }
}