<?php

use Model\PostManager;
use Model\CommentManager;
use Model\UserManager;

function home()
{
    require('view/homePage.php');
}

function getMovies()
{
    require('view/pageMovies.php');
}

function getCharacters()
{
    require('view/pageCharacter.php');
}

function getTavern()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $userManager = new UserManager();

    $Sujets = $postManager->getSujets();    
    $commentsReported = $commentManager->getCommentsReported();
    $nbCommReport = $commentManager-> countCommReport();
    $users = $userManager->getUser();
    
    require('view/pageTavern.php');
}