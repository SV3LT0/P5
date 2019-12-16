<?php $title = "Middle Earth"; ?>
<?php session_start(); ?>
<?php ob_start(); ?>

<p><a class="link" href="index.php">Retourner à l'accueil</a><br>
<h2 id="">Personnages</h2>
    <p> 
    Cette page vous montre tous les personnages présents sur la Terre du Milieu,
    certains personnages n'apparaissent pas dans les films mais dans les livres, et parfois
    dans d'autres livres que le Seigneur des Anneaux ou le Hobbit.
    </p>
    <div id="corps"></div>

    <nav id='navPerso'>
        <a href="javascript: onClick=app.showPage(1)">1</a>
    </nav>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>