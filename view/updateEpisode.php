<?php $title = "Billet simple pour l'Alaska"; ?>
<?php session_start(); ?>
<?php ob_start(); ?>

<p><a class ="link" href="javascript:history.back()">Retour</a></p>

<h3>Modification du chapitre</h3>

<form action= "index.php?action=update&amp;id=<?=$Sujet['id']?>" method="post">
    <label for="chapitre">Numéro de chapitre</label>
    <input type="number" name="chapitre" id="chapitre" min="1" max="250" value='<?=$Sujet['numeroChapitre'] ?>'/><br>
    <label for="titre">Titre</label>
    <input type="text" name="titre" id="titre" value='<?=$Sujet['titre']?>'/><br>
    <label for="contenu"></label>
    <textarea name="contenu" id="mytextarea"><?=$Sujet['contenu']?></textarea><br>
    <input class="btn btn-light" type="submit"/>
</form>

<?php $content = ob_get_clean();?>

<?php require('template.php'); ?>