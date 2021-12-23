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
                    }else{
                    echo "<li><a href='inscription.php'>Inscription</a></li>";
                    echo "<li><a href='connexion.php'>Connexion</a></li>";
                     }
                ?>
            </nav>
        </section>
    </header>
    <main> 
        <section class = "connexion">
        <?php 
    
    if (isset($_SESSION['user'])) {
        header("Refresh: 1; url=index.php");
        echo "<div class = 'box2'>
        <h2 class = 'hdeux'>Tu es déjà connecté. </h2>
              </div>";
        exit();}
    ?>

        <div class = "caseco">
            <h3 class = "H3C">Connexion</h3>
                <form method="post">
                    <label for="login">ID </label>
                    <input type="text" name="login" id="login" ><br><br>
                    <label for="password">MDP </label>
                    <input type="password" name="password" id="password"><br>
                    <input type="submit" name="submit" value="Confirmer" class = "confirm">
                    <?php
                        if(isset($_POST['submit'])){
                            $user->connect($_POST['login'], $_POST['password']);
                        }
                    ?>
                </form>
            </div>
        </section>
    </main>
    <footer class = "footerplanning">
        <section class = "foot">
            <img class = "logo2" src="images-salles/logons.png" alt = "Logo du cinéma">
            <a href="https://github.com/ifanl-ibrahim/reservation-salles" ><img class = "logo2" src="images-salles/github.png" alt = "Logo du git"></a>
        </section>
    </footer>
</body>
</html>