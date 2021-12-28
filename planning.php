<?php
session_start();
require("classes.php");
$user = new classes();
$user->dbconnect();

if(isset($_POST['deconnexion'])){
$user->disconnect();
}
?>      

<!DOCTYPE html>
<html lang="fr">
<head> 
    <meta charset="utf-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="reservation.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shorcut icon" href="./images-salles/avatar_ciné.png">
    <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
</head>
<body class = "fondres">
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
            <?php 
                if (!isset($_SESSION['user'])) {
                    header("Refresh: 4; url=connexion.php");
                    echo "<section class = 'messageerreur'> <div class = 'box2'><h2 class = 'hdeux'> Connecte toi pour acceder au planning</h2></div></section>";
                    exit();}
            ?>
            <section class="agenda">
                <div>
                    <div>
                        <section class = "suivantprecedent">
                    <form method='post'>
                        <input type="submit" name ="precedent" value="Precedent" class = 'suiv'>
                        <input type="submit" name ="suivant" value=" Suivant " class = 'suiv'>
                        <?php
                        if (isset($_POST['suivant'])) {
                                        $_SESSION['plus']++;
                        }elseif (isset($_POST['precedent'])) {
                            $_SESSION['plus']--;
                         } else $_SESSION['plus'] = 0;
                        ?>
                    </form>
                                </section>
                        <table class="table1">
                            <thead>
                                <tr>
                                    <th>Jours</th>
                                    <th>08H - 09h</th>
                                    <th>09h - 10h</th>
                                    <th>10h - 11h</th>
                                    <th>11h - 12h</th>
                                    <th>12h - 13h</th>
                                    <th>13h - 14h</th>
                                    <th>14h - 15h</th>
                                    <th>15h - 16h</th>
                                    <th>16h - 17h</th>
                                    <th>17h - 18h</th>
                                    <th>18h - 19h</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php $user->afficher($_SESSION['plus']); ?>
                            </tbody>
                        </table>
                    </div>
                </div>              
            </section>
        </main>
    <footer class = 'footerplanning'>
        <section class="foot">
            <img class = "logo2" src="images-salles/logons.png" alt = "Logo du cinéma">
            <a href="https://github.com/ifanl-ibrahim/reservation-salles" ><img class = "logo2" src="images-salles/github.png" alt = "Logo du git"></a>
        </section>
    </footer>
</body>
</html>