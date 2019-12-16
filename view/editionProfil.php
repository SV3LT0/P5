<?php $title = 'Éditer Profil'; ?>
<?php session_start(); ?>
<?php ob_start(); ?>

<p><a class="link" href="javascript:history.back()">Retour</a></p>

<h2>Éditez votre profil</h2>

<form id="editForm" action="index.php?action=editUser" method="post">
    <label for="newPseudo">Pseudo :</label>
    <input id="newPseudo" type="text" value="" name="newPseudo" minlength='2' maxlenght='50'><br>
    <label for="newMdp1">Nouveau Mot de passe :</label>
    <input id="newMdp1" type="password" name="newMdp1" value="" minlength='6' maxlenght='50'><br>
    <label for="newMdp2">Répéter votre Mot de Passe :</label>
    <input id="newMdp2" type="password" name="newMdp2" value="" minlength='6' maxlenght='50'><br>
    <input class="btn btn-dark" type="submit" value="Éditer mon Profil"><span id="msgError"></span>
</form>
<img id="imgEdition" src="public/img/<?=$_SESSION['avatar']?>" alt="avatar"><br>
<a href="index.php?action=pageAvatar"class="btn btn-dark">Modifier ma photo de profil</a>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>