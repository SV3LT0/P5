<?php $title = 'Confirmation'; ?>
<?php $connexion ='';?>

<?php ob_start(); ?>

<p><a class="link" href="index.php">Retourner à l'accueil</a><br>
<span id="confirmation">Votre Compte a bien été modifié</span></p>



<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>