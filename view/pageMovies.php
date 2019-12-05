<?php $title = "Middle Earth"; ?>
<?php session_start(); ?>
<?php ob_start(); ?>

<h2 id="">Films</h2>
    <div id="movies">
        
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>