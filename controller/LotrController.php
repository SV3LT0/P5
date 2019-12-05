<?php

use Model\PostManager;
use Model\CommentManager; 

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

    $episodes = $postManager->getEpisodes();    
    $commentsReported = $commentManager->getCommentsReported();
    $nbCommReport = $commentManager-> countCommReport();
    
    require('view/pageTavern.php');
}


