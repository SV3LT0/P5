<?php $title = "Middle Earth"; ?>
<?php session_start(); ?>
<?php ob_start(); ?>

<p><a class="link" href="index.php">Retourner à l'accueil</a><br>
<h2>Bienvenue à la Taverne</h2>
<?php 
if (isset($_SESSION['pseudo'])) { ?>
    <a href="index.php?action=newSujet"class="btn btn-dark">Créer un nouveau Sujet</a><br/>
    <?php
    if($_SESSION['isAdmin']==1){
        if($nbCommReport>0){
            ?>
            <h4>Messages Signalés</h4>
            <div id="commSignale">
            <?php 
            while($commSignale = $commentsReported->fetch())
            {
                foreach ($users as $user)
                {
                    if ($user['id']== $commSignale['idAuteur']) 
                    {?>
                        <p><img class="imgComm"  src="public/img/<?=$user['avatar']?>" alt="avatar">
                        <strong><?= htmlspecialchars($user['pseudo'])?></strong>
                    <?php
                    } 
                } ?>
                    le <?= $commSignale['comment_date'] ?> 
                    <a class="link" href="index.php?action=deleteComm&amp;id=<?=$commSignale['id']?>&amp;idSujet=<?=$commSignale['idTopic']?>">Supprimer</a>
                    <a class="link" href="index.php?action=cancelReport&amp;id=<?=$commSignale['id']?>">Retirer le signalement</a></p>
                    <p><?= $commSignale['contenu'] ?></p>
                </div>
            <?php
            }
        } else { ?>
        <p>Aucun commentaire signalé</p>
        <?php
        }    
    }
?>
<?php
} else { ?>
     <p><em>Connectez-vous ou inscrivez-vous pour créer un nouveau Sujet</em></p>
<?php
}
?>
<table>
    <thead>
        <tr>
            <th>Auteur</th>
            <th>Sujet</th>
            <th>Dernier message</th>
        </tr>    
    </thead>
    <tbody>
<?php
while ($data = $Sujets->fetch())
{
?>

<tr>
    <td><?=$data['auteur']?></td>
    <td><a class="link" href="index.php?action=post&amp;id=<?=$data['id'] ?>"><?= htmlspecialchars($data['titre']) ?></a></td>
    <td><em> le <?=$data['creation_date_fr'] ?></em></td>
    <?php 
    if (isset($_SESSION['isAdmin']) and $_SESSION['isAdmin']==1) { ?>
    <td>
            <a class="link" href="index.php?action=supprimer&amp;id=<?=$data['id'] ?>">Supprimer Sujet</a>
    </td>
            <?php 
            } 
            ?>
</tr>
<?php
}
$Sujets->closeCursor();
?>
    </tbody>
    </table>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>