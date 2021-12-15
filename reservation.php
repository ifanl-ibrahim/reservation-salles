<?php
session_start();

if (isset($_POST['deco'])) {
    session_unset ();
    header("Location: connexion.php");}

$connexion = mysqli_connect('localhost', 'root', '', 'reservationsalles');

if (!isset($_SESSION['login'])) {
    header("Refresh: 2; url=connexion.php");
    echo "<p>connecte toi.</p><br><p>Redirection...</p>";
    exit();
}
if (!$connexion) {
    echo "Erreur connexion";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./reservationsalles.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserver ici</title>
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

<main class="rev">
    <div class="rev1">
        <form id= 'general' action= 'reservation.php' method='POST'>
            <label>Évenement</label><br>
            <input type='text' id='titre' name='titre' placeholder='Pour quel évenement ?' required><br>
            <textarea id='description' name='description' placeholder='Description de lévenement' required></textarea><br>
            <input type='datetime-local' name='heureDebut' id='date' min='YYYY-MM-DD 08:00.00' max='YYYY-MM-DD 18:00.00' required><br>
            <input type='datetime-local' name='heureFin' id='date' min='YYYY-MM-DD 09:00.00' max='YYYY-MM-DD 19:00.00' required><br>
            <input type='submit' value='valider évenement' name='submit'>
        </form>

    <?php
    if(isset($_SESSION['login'])) {
        if(isset($_POST['submit'])){
            $id = $_SESSION['id']['id'];
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $debut = date("Y-m-d h:i:s", strtotime($_POST['heureDebut']));
            $fin = date("Y-m-d h:i:s", strtotime($_POST['heureFin']));
            $requete="INSERT INTO `reservations`(`id`, `titre`, `description`, `debut`, `fin`, `id_utilisateur`) VALUES (NULL, '$titre', '$description', '$debut', '$fin', $id)";
            $req = mysqli_query($connexion, $requete);           
                header("location: planning.php");
        }
    }

    ?>
    </div>
</main>

<footer>
    <a href="https://github.com/ifanl-ibrahim/reservation-salles"><img src="./images/masterhacks_github_actualiza_politicas_eliminar_codigos_poc-removebg-preview (1).png" alt="logo"></a>
</footer>

</body>
</html>