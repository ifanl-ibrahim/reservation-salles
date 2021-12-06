<?php
session_start();

$connexion = mysqli_connect('localhost', 'root', '', 'reservationsalles');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./reservationsalles.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Évenement</title>
    <link rel="shorcut icon" href="./images/logo_resto.png">
    <link href="https : //fonts.googleapis.com/css2? family= Abril+Fatface & display=swap" rel="stylesheet">
</head>
<body>

<header>
    <nav class="nav">
        <!-- menu pc -->
        <ul>
            <li><a><img id="logo-navbar" src="./images/logo_resto.png"></a></li>
            <li><a href="./index.php">Home</a></li>
            <?php
                if (isset($_SESSION['login'])) {
                    echo "<li><a href='./profil.php'>House</a></li>";
                    echo "<li><a href='./planning.php'>Planning</a></li>";
                    echo "<li><a href='./reservation.php'>Reserver ici</a></li>";
                    echo "<li><a href='./reservation-form.php'>Évenement</a></li>";
                    echo "<li><form class='deco0' action='#' method='POST'><input type='submit' name='deco' value='Déconnexion'></from></li>";
                }
                else {
                    echo "<li><a href='inscription.php'>Inscription</a></li>";
                    echo "<li><a href='connexion.php'>Connexion</a></li>";
                    echo "<li><a href='./reservation-form.php'>Évenement</a></li>";
                }
            ?>
        </ul>
    </nav>

    <div class="drop">
            <!-- menu mobil  -->
            <button class="dropbutton"><img id="logo-navbar" src="./images/logo_resto.png"></button>
            <div class="container-button">
                <a href="./index.php">Home</a>
                <?php
                if (isset($_SESSION['login'])) {
                    echo "<a href='./profil.php'>House</a>";
                    echo "<a href='./planning.php'>Planning</a>";
                    echo "<a href='./reservation.php'>Reserver ici</a>";
                    echo "<a href='./reservation-form.php'>Évenement</a>";
                    echo "<form class='deco0' action='#' method='POST'><input type='submit' name='deco' value='Déconnexion'></from>";
                }
                else {
                    echo "<a href='inscription.php'>Inscription</a>";
                    echo "<a href='connexion.php'>Connexion</a>";
                    echo "<a href='./reservation-form.php'>Évenement</a>";
                }
                ?>
            </div>
        </div>
</header>

<main>
    <?php

            $req="SELECT utilisateurs.login,`titre`,`description`,`debut`,`fin` FROM reservations INNER JOIN utilisateurs ON utilisateurs.id= reservations.id_utilisateur";
            $query=mysqli_query($connexion,$req);
            $results=mysqli_fetch_all($query);
            foreach($results as $key=>$values){
                foreach($values as $key=>$value){
                    if($key==0){
                        echo "<h5>Posté par: ".$value."</h5>";
                    }
                    if($key==1){
                        echo "<h5>Évenement: ".$value."</h5>";
                    }
                    if($key==2){
                        echo "<h6>Description: ".$value."</h6>";
                    }
                    if($key==3){
                        echo "<h7>Pour le : ".$value."</h7>"."</br>";
                    }
                    if($key==4){
                        echo "<h7>Au : ".$value."</h7>"."</br>";
                        echo "<hr>";
                    }
                }
            }
        
    ?>
</main>

<footer>
    <a href="https://github.com/ifanl-ibrahim/reservation-salles"><img src="./images/masterhacks_github_actualiza_politicas_eliminar_codigos_poc-removebg-preview (1).png" alt="logo"></a>
</footer>

</body>
</html>