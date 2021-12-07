<?php
session_start();

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
    <?php
        if(isset($_SESSION['login'])) {
            // var_dump($_SESSION['id']);
            echo "<form id= general action=# method='get'>
            <label for='titre'>Évenement</label><br>
            <input type='text' id='titre' name='titre' placeholder='Pour quel évenement ?' required><br>
            <textarea id='description' name='description' placeholder='Description de lévenement' required></textarea><br>
            <input type='date' name='date' id='date' class = 'datedufilm'><br>
            <select name='heureDebut' id='debut'>
                <option value='08'>de 08:00h</option>
                <option value='09'>de 09:00h</option>
                <option value='10'>de 10:00h</option>
                <option value='11'>de 11:00h</option>
                <option value='12'>de 12:00h</option>
                <option value='13'>de 13:00h</option>
                <option value='14'>de 14:00h</option>
                <option value='15'>de 15:00h</option>
                <option value='16'>de 16:00h</option>
                <option value='17'>de 17:00h</option>
                <option value='18'>de 18:00h</option>
            </select>
            <select name='heureFin' id='fin'>
                <option value='09'>de 09:00h</option>
                <option value='10'>de 10:00h</option>
                <option value='11'>de 11:00h</option>
                <option value='12'>de 12:00h</option>
                <option value='13'>de 13:00h</option>
                <option value='14'>de 14:00h</option>
                <option value='15'>de 15:00h</option>
                <option value='16'>de 16:00h</option>
                <option value='17'>de 17:00h</option>
                <option value='18'>de 18:00h</option>
                <option value='19'>de 19:00h</option>
            </select>
            <input type='submit' value='valider évenement' name='submit'>
            </form>";
            if(isset($_GET['submit'])){

                foreach ($_GET as $key=>$value) {
                    if($key=="description"){
                        $description=$value;
                    }
                
                    if($key=="titre"){
                        $titre=$value;
                    }

                $idTab = $_SESSION['id'];
                $id = $idTab['id'];
                $date = $_POST['date'];
                $debut = (int) $_POST['heureDebut'];
                $fin = (int) $_POST['heureFin'];
                $diff = $fin - $debut;
                $req = "INSERT INTO `reservations`(`titre`, `description`, `date`, `debut`, `fin`, `id_utilisateur`) VALUES ($titre, $description, $date ,$debut , $fin, $id)";
                var_dump($req);
                $query = mysqli_query($connexion,$req);
                        header("location: planning.php");
                }
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