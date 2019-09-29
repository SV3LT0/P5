<?php $title = 'Insciption'; ?>
<?php $connexion ='';?>

<?php ob_start(); ?>

<p><a class="link" href="index.php">Retour</a></p>

<h3>Inscription</h3>
<form action="index.php?action=addUser" method="post">
    <label for='pseudo'> Pseudo </label>
    <input type='text' name='pseudo' id='pseudo'/><br/>
    <label for='mdp'>Mot de Passe</label>
    <input type='password'name='mdp' id='mdp'/><br/>
    <label for='verifMdp'>Répéter votre Mot de Passe</label>
    <input type='password'name='verifMdp' id='verifMdp'/><br/>
    <input class="btn btn-dark" type='submit' value="S'inscrire"/>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>