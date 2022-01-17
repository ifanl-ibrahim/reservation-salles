<?php
session_start();
require("classes.php");
$user = new classes();

if(isset($_POST['deconnexion'])){
$user->disconnect();
}
?>      


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="reservation.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shorcut icon" href="./images-salles/avatar_ciné.png">
    <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
  </head>
<body class = "fondu">
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
    <div class = "deuxieme">
        <div class = "align">
            <div class = "box">
                <p>
                <h2 class = "hdeux">Un confort absolu</h2>
                <p>La salle N&S Cinema vous invite à vous vous installer sur des fauteuils premium totalement inclinables avec une assise plus large qu’à l’accoutumée.<br>
                Le design de la salle est conçu pour réduire les nuisances visuelles et offrir une vue optimale depuis chaque fauteuil.</p>
            </div>
            <div class = "box">
                <h2 class = "hdeux">Des images extraordinaires</h2>
                <p>Grâce à la technologie N&S Vision, l’histoire prend vie sous vos yeux.<br>
                Les films présentés avec N&S Vision se parent d’une brillance extraordinaire, d’un contraste incomparable et de couleurs fascinantes.</p>
            </div>
            <div class = "box">
                <h2 class = "hdeux">Un son qui voyage</h2>
                <p>Le système Dolby Atmos vous transporte au cœur de l’action avec des sons incroyablement réalistes qui voyagent dans la salle et vous enveloppent.<br>
                Derrière vous, au-dessus de vos têtes, sur les côtés, le son est partout et se déplace autour de vous, en parfaite synchronisation avec l’action à l’écran.<br>
                </p>
            </div>
        </div>
    </div>
      
</main>
<footer class = "footerplanning">
<section class = "foot">
        <img class = "logo2" src="images-salles/logons.png" alt = "Logo du cinéma">
        <a href="https://github.com/ifanl-ibrahim/reservation-salles" ><img class = "logo2" src="images-salles/github.png" alt = "Logo du git"></a>
</section>
</footer>
</body>
</html>
