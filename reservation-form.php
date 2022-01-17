<?php
session_start();
include("classes.php");
$user = new classes();

if(isset($_POST['supprimer'])){
header("refresh: 1.5");
}
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Reservation</title>
    <link rel="stylesheet" href="reservation.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shorcut icon" href="./images-salles/avatar_ciné.png">
    <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
  </head>
<body class = "fondres2">
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
        <section class = "padding">
        <form action="" method="POST">

            <div class = "reserverunesalle">
                <h2 class = "hdeux">RESERVER UNE SALLE</h2>
                <img class = "camera" src="images-salles/cinema.png" alt = "Logo caméra">
            </div> 
            <section class = "selectionfilm"> 
                <?php                
                if (!isset($_SESSION['user'])) {
                header("Refresh: 4; url=connexion.php");
                echo "<div class = 'box2'>
                <h2 class = 'hdeux'> Connecte toi pour reserver une salle</h2></div>";
                exit();
                }
                ?>
            <div class = "box2">
            <h2 class = "hdeux">Titre de votre film</h2>
            <label for="username"></label>
            <input type="text" name="titre" id="titre" placeholder="Titre du film désirée"  class = "titredufilm"><br>
            <img  src="images-salles/popcorn.png" alt = "Logo Pop corn">
        </div>
        <div class = "box2">
        <h2 class = "hdeux">Déscription du film</h2>
            <label for="description"></label>
            <textarea name="description" id="description" placeholder="Type du film" class = "descriptiondufilm" ></textarea>
        </div>
        <div class = "box2">
        <h2 class = "hdeux">Date de la séance</h2>
            <br>
            <label for="date"></label>
            <input type="date" name="date" id="date" class = "datedufilm">
            
            <h2 class = "hdeux">Heure</h2><br>
            <div class="heure">
                
                <label for="heureDebut"></label>
                <select name="heureDebut" id="debut" class = "heuredufilm">
                    <option value="08">de 08:00h</option>
                    <option value="09">de 09:00h</option>
                    <option value="10">de 10:00h</option>
                    <option value="11">de 11:00h</option>
                    <option value="12">de 12:00h</option>
                    <option value="13">de 13:00h</option>
                    <option value="14">de 14:00h</option>
                    <option value="15">de 15:00h</option>
                    <option value="16">de 16:00h</option>
                    <option value="17">de 17:00h</option>
                    <option value="18">de 18:00h</option>
                </select>
                <select name="heureFin" id="fin" class = "heuredufilm">
                    <option value="09">de 09:00h</option>
                    <option value="10">de 10:00h</option>
                    <option value="11">de 11:00h</option>
                    <option value="12">de 12:00h</option>
                    <option value="13">de 13:00h</option>
                    <option value="14">de 14:00h</option>
                    <option value="15">de 15:00h</option>
                    <option value="16">de 16:00h</option>
                    <option value="17">de 17:00h</option>
                    <option value="18">de 18:00h</option>
                    <option value="19">de 19:00h</option>
                </select>
            </div>
        </div> 
        </section>

            <!-- affiche seulement les reservations du user pour pouvoir le supprimer juste apres si il le veut -->
            <!-- (pour voir les réservations de tout les utilisateur voir page Évenement) -->

            <input type="submit" name="submit" value="Reserver" class = " validation ">
            <?php
            if(isset($_POST['submit'])){
                $date = $_POST['date'];
                $debut = (int) $_POST['heureDebut'];
                $fin = (int) $_POST['heureFin'];
                $diff = $fin - $debut;
                $user->reservation($_POST['titre'], $_POST['description'], $date, $debut, $fin, $diff, $_SESSION['user']['id']);
            }
            ?>
                <h2 class = 'hdeuxdeux'>Mes réservations</h2>
            <?php 
            $user->resafait($_SESSION['user']['id']);
            echo '<input type="submit" name="supprimer" value="supprimer" class = " validation ">';
            if(isset($_POST['supprimer'])){
                $user->suppresa($_SESSION['user']['id']);
            }
            ?>   
        </form>
        </section>
        <footer>
            <?php 
            if(isset($_POST['deconnexion'])){
                $user->disconnect();
            }
            ?>
            <section class = "foot">
                <img class = "logo2" src="images-salles/logons.png" alt = "Logo du cinéma">
                <a href="https://github.com/ifanl-ibrahim/reservation-salles" ><img class = "logo2" src="images-salles/github.png" alt = "Logo du git"></a>
            </section>
        </footer>
    </body>
</html>