<?php $title = "Middle Earth"; ?>
<?php session_start(); ?>
<?php ob_start(); ?>

<h2>Bienvenue à la Taverne</h2>
<?php 
if (isset($_SESSION['pseudo'])) { ?>
    <a href="index.php?action=newEpisode"><button type="button" id="createTopic" class="btn btn-dark">Créer un nouveau sujet</button></a><br/>
    <?php
    if($_SESSION['isAdmin']==1){
        if($nbCommReport>0){
            while($commSignale = $commentsReported->fetch())
            {
                ?>
                <h4>Messages Signalés</h4>
                <div id="commSignale">
                    <p><strong><?= htmlspecialchars($commSignale['auteur']) ?></strong> le <?= $commSignale['comment_date'] ?> 
                    <a class="link" href="index.php?action=deleteComm&amp;id=<?=$commSignale['id']?>&amp;idEpisode=<?=$commSignale['idEpisode']?>">Supprimer</a>
                    <a class="link" href="index.php?action=cancelReport&amp;id=<?=$commSignale['id']?>">Retirer le signalement</a></p>
                    <p><?= nl2br(htmlspecialchars($commSignale['contenu'])) ?></p>
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
     <p><em>Connectez-vous ou inscrivez-vous pour créer un nouveau sujet</em></p>
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
while ($data = $episodes->fetch())
{
?>

<tr>
    <td>L'auteur</td>
    <td><a class="link" href="index.php?action=post&amp;id=<?=$data['id'] ?>"><?= htmlspecialchars($data['titre']) ?></a></td>
    <td><em> le <?=$data['creation_date_fr'] ?></em></td>
    <?php 
    if (isset($_SESSION['isAdmin']) and $_SESSION['isAdmin']==1) { ?>
    <td>
            <a class="link" href="index.php?action=supprimer&amp;id=<?=$data['id'] ?>">Supprimer sujet</a>
    </td>
            <?php 
            } 
            ?>
</tr>
<?php
}
$episodes->closeCursor();
?>
    </tbody>
    </table>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>