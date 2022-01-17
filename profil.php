<?php
session_start();
require "./classes.php";
$user = new classes();
if(isset($_POST['deconnexion'])){
    $user->disconnect();
    }
$login=$_SESSION['user']['login'];
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="reservation.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shorcut icon" href="./images-salles/avatar_ciné.png">
    <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
  </head>
<body class = "fond2">
    <header>
        <section class = "head">
            <img class = "logo" src="images-salles/logons.png" alt = "Logo du cinéma">
            <nav>
                <li><a href = "index.php">Accueil<a></li>
                <li><a href='reservation.php'>Évenement</a></li>
                <?php 
                if (isset($_SESSION['user'])) {
                echo "<li><a href='reservation-form.php'>Reservation</a></li>";
                echo "<li><a href='planning.php'>Planning</a></li>";
                echo "<li><a href='profil.php'>Profil</a></li>";
                echo "<li><form method='post'><input type = 'submit' name = 'deconnexion' value='Deconnexion' class = 'deco'></form></li>";
                }
                else{
                echo "<li><a href='inscription.php'>Inscription</a></li>";
                echo "<li><a href='connexion.php'>Connexion</a></li>";
                }?>
            </nav>
        </section>
    </header>

    <main>
        <article class="titre_profil">
            <h1 class="titre_user">My House</h1> <br><br>
        </article>

        <article class="info">
            <section id="bienvenue">
                <?php
                    if (!isset($_SESSION['user'])) {
                        header("Refresh: 2; url=connexion.php");
                        echo "<p>connecte toi.</p><br><p>Redirection...</p>";
                        exit();
                    }

                    echo "<h3 class='titre_user'>Bienvenue sur ton profil $login</h3>";
                ?>
            </section>
            <br><br>
            <form class="profil" action="#" method="POST">
                <input class="btn" type="submit" id="modifier" name="modifier" value="Modifier mes information"> <br><br>


            <!-- UPDATE -->

            <?php

            //zone de modif//

                if (isset($_POST['modifier'])) {
                    echo "<p id= modif>Modifier le Login <input type=\"submit\" name=\"modifierlogin\" value=\"ici\"><br>
                                    Modifier le Mot de passe <input class='btn' type=\"submit\" name=\"modifierpass\" value=\"ici\"></p><br>";
                }

            //modif login//
        
                if (isset($_POST['modifierlogin'])) {
                    echo  
                        "<form method=\"post\">
                            <input type=\"text\" name=\"login\" id=\"login\" placeholder=\"nouveau login\">
                            <input class='btn' type=\"submit\" name=\"validerlog\" value=\"valider\">
                            </form>";
                }

                if(isset($_POST['validerlog'])) {
                    $user -> updatelog($_POST['login']);
                }

            //modif password//
        
                if (isset($_POST['modifierpass'])) { 
                    echo 
                        "<form method=\"post\">
                            <input type=\"text\" name=\"pass\" id=\"nom\" placeholder=\"Entrer un nouveau Password\"><br>
                            <input class='btn' type=\"submit\" name=\"validerpass\" value=\"valider\">
                        </form>
                    ";
                }

                if(isset($_POST['validerpass'])) {
                    $user -> updatepass($_POST['pass']);
                }
            ?>
                <input class="btn" type="submit" id="supprimer" name="supprimer" value="Supprimer mon compte"> <br><br>
                    <?php $user->deleteuser($_SESSION['user']['id']); ?>
            
            </form>
        </article>
    </main>

    <footer class = "footerplanning">
        <section class = "foot">
            <img class = "logo2" src="images-salles/logons.png" alt = "Logo du cinéma">
            <a href="https://github.com/ifanl-ibrahim/reservation-salles" ><img class = "logo2" src="images-salles/github.png" alt = "Logo du git"></a>
        </section>
    </footer>

</body>
</html>