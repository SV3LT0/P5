<?php $title = 'Éditer Profil'; ?>
<?php session_start(); ?>
<?php ob_start(); ?>

<p><a class="link" href="javascript:history.back()">Retour</a></p>

<h3>Éditez votre profil</h3>

<form action="index.php?action=editUser" method="post">
    <label for="newPseudo">Pseudo :</label>
    <input type="text" value="<?= $_SESSION['pseudo']?>" name="newPseudo" ><br>
    <label for="newMdp1">Mot de passe :</label>
    <input type="password" name="newMdp1"><br>
    <label for="newMdp2">Répéter votre Mot de Passe :</label>
    <input type="password" name="newMdp2"><br>
    <input class="btn btn-dark" type="submit" value="Éditer mon Profil">
</form>
<img id="imgEdition" src="public/img/<?=$_SESSION['avatar']?>" alt="avatar"><br>
<a href="index.php?action=pageAvatar"><button class="btn btn-dark">Modifier ma photo de profil</button></a>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>