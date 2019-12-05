<?php

namespace Model;


class UserManager extends Manager
{
    public function inscription($pseudo,$mdp_hash)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO utilisateur(pseudo, mdp, isAdmin, avatar)VALUES(:pseudo, :mdp, 0, "base.png")');
        $ajoutUtilisateur = $req->execute(array('pseudo'=>$pseudo,'mdp'=>$mdp_hash));

        return $ajoutUtilisateur;
    }

    public function testPseudo($pseudo)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id FROM utilisateur WHERE pseudo=?');
        $req->execute(array($pseudo));
        $pseudoUnique = $req->fetch();

        return $pseudoUnique;
    }

    public function connexionUtilisateur($pseudo, $mdp)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, pseudo, mdp, isAdmin, avatar FROM utilisateur WHERE pseudo = :pseudo');
        $req->execute(array('pseudo'=>$pseudo));
        $resultat = $req->fetch();

        return $resultat;
    }

    public function editPseudo($newPseudo, $idUser)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE utilisateur SET pseudo=:pseudo WHERE id=:id');
        $changementPseudo=$req->execute(array('pseudo'=>$newPseudo, 'id'=>$idUser));

        return $changementPseudo;
    }

    public function editMdp($mdp, $idUser)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE utilisateur SET mdp=:mdp WHERE id=:id');
        $changementMdp = $req->execute(array('mdp'=>$mdp, 'id'=>$idUser));

        return $changementMdp;
    }
    
    public function ajoutAvatar($avatarName, $idUser)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE utilisateur SET avatar=:avatar WHERE id=:id');
        $ajoutAvatar = $req->execute(array('avatar'=>$avatarName, 'id'=>$idUser));

        return $ajoutAvatar;
    } 

    public function getUser()
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, pseudo, avatar FROM utilisateur');
        $req->execute();
        $getUsers = $req->fetchAll();
        
        return $getUsers;
    }
}

?>