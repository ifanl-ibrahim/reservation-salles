<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./reservationsalles.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
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
    <form id= general method="post">
    <h1>Inscription</h1>
    <input type="text" placeholder="Login" name="login" required><br/>
    <input type="password" placeholder="Mot de passe" name="password" required><br/>
    <input type="password" placeholder="Confirmation du mot de passe" name="confirm_password" required><br/>
    <input type="submit" name="submit"/>
    </form>

    <section class="erreur">
        <?php
        session_start();
        if (isset($_SESSION['login'])) {
            $login_session = $_SESSION['login'];
            header ("location:index.php");}

        $connexion = mysqli_connect('localhost', 'root', '', 'reservationsalles');

        if(isset($_POST['submit'])){
            $login = trim($_POST['login']);
            $password = trim($_POST['password']);
            $confirm = trim($_POST['confirm_password']);
            $verif = "SELECT login FROM utilisateurs WHERE login = '$login'";
            $verif_suite = mysqli_query($connexion, $verif);
        
        
            if(!empty($login) && !empty($password) && !empty($confirm)) {
                if(mysqli_num_rows($verif_suite) == 0){  //calcule et verifie dans la base de donnée 
                    if($password == $confirm) { 
                        $query = "INSERT INTO utilisateurs (login, password) VALUES ('$login', '$password')"; //ajoute les info dans la base de donnée
                        mysqli_query($connexion, $query);
                        header("Location:connexion.php"); //redigire vers la page connexion
                    }
                    else echo $erreur = '<p id="erreur">Les mots de passe ne sont pas identiques.</p>';
                } 
                else echo $erreur = '<p id="erreur">Ce login existe déja</p>';
            }
        }
        ?>
    </section>

</main>

<footer>
    <a href="https://github.com/ifanl-ibrahim/reservation-salles"><img src="./images/masterhacks_github_actualiza_politicas_eliminar_codigos_poc-removebg-preview (1).png" alt="logo"></a>
</footer>

</body>
</html>