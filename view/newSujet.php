<?php $title = "Nouveau Sujet"; ?>
<?php session_start(); ?>
<?php ob_start(); ?>


<p><a class="link" href="javascript:history.back()">Retour</a></p>

<h2>Ecriture d'un nouveau sujet</h2>

<form action="index.php?action=addSujet" method="post">
    <label for="titre">Titre</label>
    <input type="text" name="titre" id="titre"/><br>
    <label for="contenu"></label>
    <textarea name="contenu" id="mytextarea"></textarea><br>
    <input class="btn btn-dark" type="submit"/>
</form>

<?php $content = ob_get_clean();?>

<?php require('template.php'); ?>
