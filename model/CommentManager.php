<?php

namespace Model;


class CommentManager extends Manager
{
    public function getComments($SujetId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, contenu, idTopic, idAuteur, signale, DATE_FORMAT(dateComm, "%d/%m/%Y à %Hh%imin%ss")AS comment_date FROM post WHERE idTopic = ? ORDER BY dateComm');
        $comments->execute(array($SujetId));

        return $comments;
    }
    
    public function postComment($sujetId, $comment, $idAuteur)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO post(idTopic, idAuteur, contenu, dateComm, signale)VALUES(:idTopic,:idAuteur,:contenu,NOW(),0)');
        $affectedLines = $req->execute(array('idTopic'=>$sujetId,'contenu'=>$comment,'idAuteur'=>$idAuteur));
    
        return $affectedLines;
    }

    public function deleteComment($id)
    {
        $db = $this->dbConnect();
        $deleteComment = $db->prepare('DELETE FROM post WHERE id=:id');
        $affectedLines = $deleteComment->execute(array('id'=>$id));

        return $affectedLines;
    }

    public function signaleCommentaire($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE post SET signale=1 WHERE id=:id');
        $commentSignale = $req->execute(array('id'=>$id));

        return $commentSignale;
    }

    public function getCommentsReported()
    { 
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, idAuteur, contenu, idTopic, signale, DATE_FORMAT(dateComm, "%d/%m/%Y à %Hh%imin%ss")AS comment_date FROM post WHERE signale = 1');

        return $req;
    }

    public function countCommReport()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(*) FROM post WHERE signale = 1');
        $nbCommentaireReported = $req->fetchColumn();

        return $nbCommentaireReported;
    }

    public function annuleSignale($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE post SET signale=0 WHERE id=:id');
        $annuleSignale = $req->execute(array('id'=>$id));

        return $annuleSignale;
    }

    public function deleteCommEp($idEp)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM post WHERE idTopic = :idEp');
        $deleteCommEp = $req->execute(array('idEp'=>$idEp));

        return $deleteCommEp;
    }
}

?>