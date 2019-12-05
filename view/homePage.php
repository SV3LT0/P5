<?php $title = "Les Terres du Milieu"; ?>
<?php session_start(); ?>
<?php ob_start(); ?>

<h2>Bienvenue dans les Terres du Milieu</h2>

<p id="presentation">Bonjour Rodeur ! Vous trouverez ici de nombreuses informations sur tous les personnages et films du monde de JRR Tolkien. <br>
Rendez-vous à la taverne pour rencontrer d’autres elfes, nains et parfois des hobbits! <br>
Profitez-en et n'oubliez pas de vous inscrire!</p>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>