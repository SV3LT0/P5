<?php

namespace Model;

class PostManager extends Manager
{
    public function getSujets()
    {
        $db = $this->dbConnect();
        $req = $db ->query('SELECT id, titre, auteur, DATE_FORMAT(creation_date, "%d/%m/%Y")AS creation_date_fr FROM Sujet ORDER BY creation_date_fr DESC');

        return $req;
    }

    public function getSujet($SujetId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, titre, DATE_FORMAT(creation_date, "%d/%m/%Y")AS creation_date_fr FROM Sujet WHERE id = ?');
        $req->execute(array($SujetId));
        $Sujet = $req->fetch();

        return $Sujet;
    }

    public function getSujetByTitle($titre)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id FROM Sujet WHERE titre = ?');
        $req->execute(array($titre));
        $Sujet = $req->fetch();

        return $Sujet;
    }

    public function newSujet($titre, $auteur)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO Sujet(titre, auteur, creation_date)VALUES(:titre, :auteur, CURDATE())');
        $nouvelSujet = $req->execute(array('titre'=>$titre, 'auteur'=> $auteur));
        
        return $nouvelSujet;
    }

    public function deletSujet($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM Sujet WHERE id = :id');
        $deleteSujet = $req->execute(array('id'=>$id));

        return $deleteSujet;
    }

    public function updateDate($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE Sujet SET creation_date=CURDATE() WHERE id=:id');
        $updateDate = $req->execute(array('id'=>$id));
        
        return $updateDate;
    }
}

?>