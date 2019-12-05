<?php $title = htmlspecialchars($episode['titre']); ?>
<?php session_start(); ?>
<?php ob_start(); ?>
<p><a class="link" href="javascript:history.back()">Retour</a></p>

<div>
    <h3>
        <?= htmlspecialchars($episode['titre'])?>
    </h3>
</div>

<?php 

while ($comment = $comments->fetch())
{
    foreach ($users as $user)
    {
        if ($user['id']===$comment['idAuteur']) {?>
            <p><img class="imgComm"  src="public/img/<?=$user['avatar']?>" alt="avatar">
            <strong><?= htmlspecialchars($user['pseudo']) ?>
        <?php
        }
    }
    ?>
    </strong> le <?= $comment['comment_date'] ?>
    <a class="link" href="index.php?action=reportComm&amp;id=<?=$comment['id']?>&amp;idEpisode=<?=$comment['idTopic']?>">Signaler</a>
    <?php 
    if (isset($_SESSION['isAdmin']) and $_SESSION['isAdmin']==1) { ?>
    <a class="link" href="index.php?action=deleteComm&amp;id=<?=$comment['id']?>&amp;idEpisode=<?=$comment['idTopic']?>">Supprimer</a></p>
    <?php
    }
    ?>
    <p class="contenuMsg"><?= nl2br(htmlspecialchars($comment['contenu'])) ?></p>
<?php

}
$comments->closeCursor();
?>

<form id="formComm" action= "index.php?action=addComment&amp;id=<?=$episode['id']?>" method="post">
    <?php
    if(isset($_SESSION['pseudo'])){?>
        <div id = "invisible">
            <label for="auteur">Pseudo</label><br/>
            <input type="text" id="auteur" name="auteur" value="<?= $postPseudo ?>" />
        </div>
        <div>
            <label for="message">Message</label><br/>
            <textarea id="mytextarea" name="commentaire"></textarea>
        </div>
        <div>
            <input class="btn btn-dark" type="submit"/>
        </div>
</form>
    <?php
    }else{?>
        <p><em>Connectez-vous ou inscrivez-vous pour répondre au sujet</em></p>
        <?php
    }
        ?>

<?php $content = ob_get_clean();?>

<?php require('template.php'); ?>