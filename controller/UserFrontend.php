<?php

use Model\UserManager;


function pageInscription()
{
    require('view/inscription.php');
}

function addUser($pseudo, $mdp)
{
    $userManager = new UserManager();
    $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);

    $pseudoUnique = $userManager->testPseudo($pseudo);
    if ($pseudoUnique === false) {
       $ajoutUtilisateur = $userManager->inscription($pseudo, $mdp_hash);

        if($ajoutUtilisateur === false){
            throw new Exception ('Impossible d\'ajouter l\'utilisateur');
        }
        else{
            require('view/compteCréé.php');
        }
    } else {
        throw new Exception ('Ce nom d\'utilisateur est deja pris');
    }
}

function connexion($pseudo, $mdp)
{
    $userManager = new UserManager();
    $connexionUtilisateur = $userManager->connexionUtilisateur($pseudo, $mdp);

    $passwordCorrect = password_verify($mdp, $connexionUtilisateur['mdp']);

    if (!$connexionUtilisateur){
        echo 'Mauvais identifiant ou mot de passe !';
    } elseif ($passwordCorrect) {
        session_start();
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['isAdmin'] = $connexionUtilisateur['isAdmin'];
        $_SESSION['id'] = $connexionUtilisateur['id'];
        $_SESSION['avatar'] = $connexionUtilisateur['avatar'];
        header('Location: index.php');
    } else {
        echo 'Mauvais identifiant ou mot de passe !';
    }
}

function déconnexion()
{
    session_start();
    $_SESSION = array();
    session_destroy();
    header('Location: index.php');
}

function pageEditionProfil()
{
    require('view/editionProfil.php');
}

function editerUser($newPseudo, $newMdp1, $newMdp2, $idUser, $oldPseudo)
{
    $userManager = new UserManager();
 
    if (!empty($newPseudo) && $newPseudo!=$oldPseudo) {
        $editPseudo = $userManager->editPseudo($newPseudo, $idUser);
    }
    if (!empty($newMdp1) && !empty($newMdp2)) {
        if($newMdp1==$newMdp2){
            $mdp1 = password_hash($newMdp1, PASSWORD_DEFAULT);

            $editMdp = $userManager->editMdp($mdp1, $idUser);
        } else {
            throw new Exception ('Vos deux Mot de passe ne correspondent pas');
        }
    }

    header('Location: index.php');
}

function pageAvatar()
{
    require('view/ajoutPhoto.php');
}

function editAvatar($avatarName, $avatarTmpName, $avatarSize)
{   
    session_start();
    $idUser = $_SESSION['id'];
    $extension = strtolower(substr(strrchr($avatarName, '.'), 1));
    $legaleExtension = array("jpg", "png", "jpeg");
    $maxSize = 2000000;

    if ($avatarSize > 0 AND $avatarSize < $maxSize ) {
        if(in_array($extension, $legaleExtension)){
            $newName = $idUser.".".$extension;
            $chemin="public/img/".$newName;
            move_uploaded_file($avatarTmpName,$chemin);

            $userManager = new UserManager();
            $ajoutAvatar = $userManager->ajoutAvatar($newName,$idUser);

            if ($editPhotoProfil===false) {
                throw new Exception ('Impossible de modifier votre photo de profil');
            }else{
                $_SESSION['avatar']=$newName;
                header('Location: index.php?action=editerProfil');
            }
        }else{
            throw new Exception ('Le type de fichier n\'est pas correct !');
        }
    }else {
        throw new Exception ('Le poids du fichier ne convient pas !');
    }
}