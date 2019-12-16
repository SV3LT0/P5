<?php $title = 'Insciption'; ?>

<?php ob_start(); ?>

<p><a class="link" href="javascript:history.back()">Retour</a></p>

<h2>Inscription</h2>
<form id="formUser" action="index.php?action=addUser" method="post">
    <label for='pseudo'> Pseudo </label>
    <input type='text' name='pseudo' id='pseudo' minlength='2' maxlenght='50' required/><br/>
    <label for='mdp'>Mot de Passe</label>
    <input type='password'name='mdp' id='mdp' minlength='6' maxlenght='50' required/><br/>
    <label for='verifMdp'>Répéter votre Mot de Passe</label>
    <input type='password'name='verifMdp' id='verifMdp' minlength='6' maxlenght='50' required/><br/>
    <input class="btn btn-dark" type='submit' value="S'inscrire"/><span id="msgError"></span>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>