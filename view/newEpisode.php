<?php $title = "Billet simple pour l'Alaska"; ?>
<?php session_start(); ?>
<?php ob_start(); ?>


<p><a class="link" href="javascript:history.back()">Retour</a></p>

<h3>Ecriture d'un nouvel sujet</h3>

<form action="index.php?action=addEpisode" method="post">
    <label for="titre">Titre</label>
    <input type="text" name="titre" id="titre"/><br>
    <label for="contenu"></label>
    <textarea name="contenu" id="mytextarea"></textarea><br>
    <input class="btn btn-dark" type="submit"/>
</form>

<?php $content = ob_get_clean();?>

<?php require('template.php'); ?>
