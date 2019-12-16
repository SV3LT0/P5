<?php $title = "connexion"; ?>
<?php session_start(); ?>
<?php ob_start(); ?>
<p><a class="link" href="javascript:history.back()">Retour</a></p>

<div id="ecranConnexion">
    <h2>Connexion</h2>
    <form action= "index.php?action=connexion" method="post">
        <label for='pseudo'>Pseudo</label>
        <input type='text' name='pseudo' id='pseudo'/><br/>
        <label for='mdp'>Mot de Passe</label>
        <input type='password'name='mdp' id='mdp'/><br/>                
        <input class="btn btn-dark" type='submit' value="Connexion"/>
    </form>
    <p>Vous ne disposez pas encore de compte ? Inscrivez-vous !</p>
    <a class="btn btn-dark" href="index.php?action=inscription">S'inscire</a><br/>   
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>