<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <meta name="viewport" content="width=device-width" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="public/style.css" rel="stylesheet" />
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
    tinymce.init({
    selector: '#mytextarea'
  });
  </script>
    </head>

    <body>
        <header id='header'>
            <a id="lienHome" href="index.php"><h1>Les Terres du Milieu</h1></a>
                <div id="onglets">
                    <a class="btn btn-dark" href="index.php?action=movies">FILMS</a>
                    <a class="btn btn-dark" href="index.php?action=character">PERSONNAGES</a>
                    <a class="btn btn-dark" href="index.php?action=tavern">TAVERNE</a>
                </div>
                    <div id="compte">
                        <?php
                            if(isset($_SESSION['pseudo'])){ ?>
                                <img id="avatar" src="public/img/<?=$_SESSION['avatar']?>" alt="avatar"><br>
                                <p>Salut <?php echo $_SESSION['pseudo'];?> <br>
                                <a class="btn btn-dark" href="index.php?action=deconnexion" >Déconnexion</a>
                                <a class="btn btn-dark" href="index.php?action=editerProfil" >Editer Profil</a></p>
                            <?php
                            } else {
                            ?> 
                                <a class="btn btn-dark" href="index.php?action=pageConnexion">Connexion</a><br/>
                                <a class="btn btn-dark" href="index.php?action=inscription">Inscription</a><br/>
                            <?php
                            } ?>
                    </div>
        </header>
        <section>
            <?= $content ?>
        </section>
        
        <script src="public/js/User.js" ></script>
        <script src="public/js/App.js" ></script>
    </body>
</html>