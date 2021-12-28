<?php
session_start();
require "./classes.php";
$user = new classes();
$user->dbconnect();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="reservation.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
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
        <h1 class="titre_user">My House</h1>
    </article>

    <article class="info">
        <section id="bienvenue">
            <?php
                if (!isset($_SESSION['user'])) {
                    header("Refresh: 2; url=connexion.php");
                    echo "<p>connecte toi.</p><br><p>Redirection...</p>";
                    exit();
                }
                
                echo "<h3 class='titre_user'>Bienvenue sur ton profil</h3>";
            ?>
        </section>
        <form class="profil" action="#" method="POST">
            <input type="submit" name="modifier" value="modifier" class = "confirm">
        </form>

                <!-- UPDATE -->

            <?php

                //zone de modif//

                if (isset($_POST['modifier'])) {
                    echo "<form method='POST'>
                    <input type=\"text\" name=\"login\" placeholder=\"newlogin\"><br>
                    <input type=\"text\" name=\"password\" placeholder=\"newpassword\"><br>
                    <input type=\"submit\" name=\"valider\" value=\"valider\"><br>
                    </form>";
                }
                if (isset($_POST['valider'])) {
                    $user->update($_POST['login'], $_POST['password']);
                }
            ?>
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