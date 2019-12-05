<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require "vendor/autoload.php";

require('controller/CommentFrontend.php');
require('controller/PostFrontend.php');
require('controller/UserFrontend.php');
require('controller/LotrController.php');


try {
    if(isset($_GET['action'])){
        if($_GET['action'] == 'listEpisodes'){
            listEpisodes();
        }
        elseif($_GET['action'] == 'post'){
            if(isset($_GET['id']) && $_GET['id']>0){
                post();
            }
            else {
                throw new Exception('Aucun identifiant d\'épisode envoyé');
            }
        }
        elseif($_GET['action']=='addComment'){
            if(isset($_GET['id']) && $_GET['id']>0){
                session_start();
                addComment($_GET['id'],$_POST['commentaire'], $_SESSION['id']);
            }
            else{
                throw new Exception('Tous les champs ne sont pas remplis');
            }
        }
        elseif($_GET['action']=='inscription'){
            pageInscription();
        }
        elseif($_GET['action']=='addUser'){
            if(!preg_match('#^(?=.*[a-z])(?=.*[0-9])#',$_POST['mdp'])){
                throw new Exception('Mot de passe non conforme');
            }
            elseif($_POST['mdp']!=$_POST['verifMdp']) {
                throw new Exception('Les deux mot de passe ne correspondent pas');
            }
            else{
                addUser($_POST['pseudo'],$_POST['mdp']);
            }
        }
        elseif ($_GET['action']=='connexion'){
            connexion($_POST['pseudo'],$_POST['mdp']);
        }
        elseif ($_GET['action']=='deconnexion') {
            déconnexion();
        }
        elseif ($_GET['action']=='editerProfil'){
            pageEditionProfil();
        }
        elseif($_GET['action']=='editUser'){
            session_start();
            editerUser($_POST['newPseudo'],$_POST['newMdp1'], $_POST['newMdp2'], $_SESSION['id'], $_SESSION['pseudo']);
        }
        elseif($_GET['action']=='pageAvatar'){
            pageAvatar();
        }
        elseif($_GET['action']=='editAvatar'){
            editAvatar($_FILES['avatar']['name'],$_FILES['avatar']['tmp_name'], $_FILES['avatar']['size'] );
        }
        elseif($_GET['action']=='newEpisode'){
            pageNewEpisode();
        }
        elseif($_GET['action']=='addEpisode'){
            addNewEpisode($_POST['titre'],$_POST['contenu'],$_POST['chapitre']);
        }
        elseif($_GET['action']=='deleteComm'){
            if(isset($_GET['id']) && $_GET['id']>0){
                deleteComm($_GET['id'], $_GET['idEpisode']);
            }
            else {
                throw new Exception('Ce commentaire n\'existe pas');
            }
        }  
        elseif($_GET['action']=='modifier'){
            if(isset($_GET['id']) && $_GET['id']>0){
                pageUpdate();
            }
            else {
                throw new Exception('Aucun identifiant d\'épisode envoyé');
            }
        }
        elseif($_GET['action']=='update'){
            updateEpisode($_POST['titre'],$_POST['contenu'],$_GET['id'], $_POST['chapitre']);
        }
        elseif ($_GET['action']=='supprimer') {
            supprimerEpisode($_GET['id']);
        }
        elseif($_GET['action']=='reportComm'){
            reportComm($_GET['id'],$_GET['idEpisode']);
        }
        elseif($_GET['action']=='cancelReport'){
            cancelReport($_GET['id']);
        }
        elseif ($_GET['action']=='movies') {
            getMovies();
        }
        elseif ($_GET['action']=='character') {
            getCharacters();
        }
        elseif ($_GET['action']=='tavern') {
            getTavern();
        }
    }
    else{
        home();
    }
}
catch(Exception $e){
    echo 'Erreur : '. $e->getMessage();
}
