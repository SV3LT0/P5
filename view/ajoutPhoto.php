<?php $title = 'Éditer Profil'; ?>
<?php session_start(); ?>
<?php ob_start(); ?>

<p><a class="link" href="index.php?action=editerProfil">Retour</a></p>

<h3>Modifiez votre photo de profil</h3>

<form action="index.php?action=editAvatar" method="post" enctype="multipart/form-data">
    <label for="avatar">Choisissez une photo de profil:</label><br>
    <input class="btn btn-dark" type="file" name="avatar" accept=".jpg, .jpeg, .png">
    <input class="btn btn-dark" type="submit" value="Envoyer">
</form>

<?php $content = ob_get_clean();?>

<?php require('template.php');?>