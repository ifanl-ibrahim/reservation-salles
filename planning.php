<?php
session_start();
$connexion = mysqli_connect('localhost', 'root', '', 'reservationsalles');
$requete = "SELECT `titre`, `description`, `debut`, `fin`, `id_utilisateur` FROM `reservations`";
$req = mysqli_query($connexion, $requete);
$res = mysqli_fetch_assoc($req);

if (isset($_POST['deco'])) {
    session_unset ();
    header("Location: connexion.php");}

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

<main>
<?php 
    if (!isset($_SESSION['login'])) {
        header("Refresh: 2; url=connexion.php");
        echo "<p>connecte toi.</p><br><p>Redirection...</p>";
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
                                }
                                elseif (isset($_POST['precedent'])) {
                                    $_SESSION['plus']--;
                                } 
                                else $_SESSION['plus'] = 0;
                            ?>
                    </form>
    </section>
    <table border="1">
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
            <?php echo $req ?>
        </tbody>
    </table>
            </div>
        </div>              
    </section>
</main>
<footer>
    <a href="https://github.com/ifanl-ibrahim/reservation-salles"><img src="./images/masterhacks_github_actualiza_politicas_eliminar_codigos_poc-removebg-preview (1).png" alt="logo"></a>
</footer>

</body>
</html>