<?php

class classes {
  private $_link;
  private $_id;
  public $_login;
  public $_password;



  ////////////////////////////////////////////////////////////////////// Fonction connexion à la BDD



  public function dbconnect() {

    $conn = new PDO("mysql:host=localhost; dbname=reservationsalles", 'root', '');
    $this->_link = $conn;

  }



  /////////////////////////////////////////////////////////////////// Fonction pour créer l'utilisateur en BDD



  public function register($_login, $_password, $_confirm_password) {

    $link = $this->_link;
    $_login = htmlspecialchars($_login);
    $_password = htmlspecialchars($_password);

    $login = trim($_login);
    $password = trim($_password);
    $confirm = trim($_confirm_password);
    $crypt = password_hash($password, PASSWORD_BCRYPT);
    $verif = "SELECT login FROM utilisateurs WHERE login = '$login'";
    $query = $link->query($verif);



    if (!empty($login) && !empty($password) && !empty($confirm)) {
      if ($query->fetch(PDO::FETCH_ASSOC) == 0) {
        if ($password == $confirm) {
          $query = "INSERT INTO utilisateurs (login, password) VALUES ('$login', '$crypt')";
          $link->query($query);
          header("Location:connexion.php");
        } 
        else echo '<br>Les mots de passe ne sont pas identiques.<br>';
      } 
      else echo '<br>Ce login existe déja<br>';
    } 
    else echo '<br>Veuillez remplir le formulaire s\'il vous plait ! <br>';
  }



  ////////////////////////////////////// Fonction qui vérifie les informations en BDD pour se connecter avec le bon utilisteur 



  public function connect($_login, $_password) {

    $_login = htmlspecialchars($_login);
    $_password = htmlspecialchars($_password);

    $this->_login = $_login;
    $this->_password = $_password;

    $link = $this->_link;

    $SQL = "SELECT * FROM utilisateurs WHERE login = '$_login'";
    $query = $link->query($SQL);
    $user = $query->fetch(PDO::FETCH_ASSOC);
    if ($_password == null) {
      echo 'remplissez tout les champs';
    } 
    else {
      if (password_verify($_password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("location: index.php");
      } 
      else {
        echo "<br>Le login ou le mot de passe n'est pas correct ! <br>";
        }
      }
  }



  ///////////////////////////////////////////////////// Fonction pour déconnecter l'utilisateur



  public function disconnect()
  {
    $this->_login = '';
    $this->_password = '';
    session_unset();
    header("refresh: 0.1; url=index.php");
  }



  /////////////////////////////////////////////// Fonction pour créer une reservation qui prend en compte ... paramètres



  public function reservation($_titre, $_description, $_date, $_hdebut, $_hfin, $_diff, $_id) {

    $link = $this->_link;
    $diffcheck = $_diff;
    $diffresa = $_diff;
    $hdebcheck = $_hdebut;
    $hdebresa = $_hdebut;
    $resapossible = true;
    $newdate = new DateTime($_date);
    date_time_set($newdate, 23, 59);
    $datenow = new DateTime('now');
    if(!empty($_titre) && !empty($_description)) {
      if($_diff >= 0) {
        if($newdate > $datenow) {
            while ($diffcheck > 0) {
              $finaldate = $hdebcheck + 1;
              $datecompleteDeb = $_date . ' ' . $hdebcheck;
              $datecompleteFin = $_date . ' ' . $finaldate;
      
              $SQL = "SELECT * FROM reservations WHERE debut = '$datecompleteDeb' AND fin = '$datecompleteFin'";
              $query = $link->prepare($SQL);
              $query->execute();
              $resultat = $query->fetch(PDO::FETCH_OBJ);
              $diffcheck--;
              $hdebcheck++;
              if($resultat) {
                $resapossible = false;
                echo "<div class = 'creneaupris'><h2 class = 'htrois'>ce créneau est déjà pris</h2></div>";
                break;
              }
            }
            if($resapossible) {
              while ($diffresa > 0) {
                $finaldate = $hdebresa + 1;
                $datecompleteDeb = $_date . ' ' . $hdebresa;
                $datecompleteFin = $_date . ' ' . $finaldate;
                
                $SQL1 = "INSERT INTO reservations(titre, description, debut, fin, id_utilisateur) VALUES ('$_titre', '$_description', '$datecompleteDeb', '$datecompleteFin', '$_id')";
                $query1 = $link->prepare($SQL1);
                $query1->execute();
                
                $diffresa--;
                $hdebresa++;
              }
              echo "<div class = 'creneaupris'><h2 class = 'htrois'>votre réservation à bien était prise en compte</h2></div>";
            }
        }    
        else {
          echo "<div class = 'creneaupris'><h2 class = 'htrois'>tu ne peux pas choisir un jour antérieur à la date d'aujourd'hui</h2></div>";
        } 
      }    
        else{
          echo "<div class = 'creneaupris'><h2 class = 'htrois'>tu ne peux pas choisir une heure de fin antérieur à celle du début</h2></div>";
        }
    }
      else{
        echo "<div class = 'creneaupris'><h2 class = 'htrois'>Remplissez tout les champs</h2></div>";
      }
  }



  //////////////////////////////////////////////// Fonction pour traduire les jours en FR



  public function dateToFrench($date, $format) {

    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date))));
  }



  ///////////////////////////////////////////////// Fonction pour afficher les reservations



  public function afficher($_j) {

    $neuf = 9+$_j;
    $link = $this->_link;
    for ($int1 = $_j; $int1 < $neuf; $int1++) {
      echo "<tr>";
      echo "<td>" . 
      $this->dateToFrench("now +$int1 day", "l <br> d/m");
      "</td>";
      for ($int = 8; $int < 19; $int++) {
        $date = $this->dateToFrench("now +$int1 day", "Y-m-d $int:00");
        $select = $link->prepare("SELECT * FROM reservations WHERE debut = '$date' ");
        $select->execute();
        $info1 = $select->fetch(PDO::FETCH_ASSOC);
        if ($info1) {
            echo "<td class='crenoPris'>" . $info1['titre'] . "</td>";
        }
        else {
          $disponible = 'Disponible';
          echo "<td class='crenoDispo'>$disponible</td>";
        }
      }
     echo "</tr>";
    };
  }



  //////////////////////////////////////////// Fonction pour afficher les réservations de l'utiisateur connecté

  public function resafait($_id) {

    $link = $this->_link;
    $SQL = $link->prepare("SELECT * FROM reservations WHERE id_utilisateur = $_id");
    $SQL->execute();
    echo "<table class = 'tableau' >";
    echo '<tr>' . '<th>' . 'Titre' . '</th>';
    echo '<th>' . 'Description' . '</th>';
    echo '<th>' . 'Debut' . '</th>';
    echo '<th>' . 'Fin' . '</th>' . '</tr>';
    foreach($SQL as $key){
     echo '<tr>' . '<td>' . $key['titre'] . '</td>';
     echo '<td>' . $key['description'] . '</td>';
     echo '<td>' . $key['debut'] . '</td>';
     echo '<td>' . $key['fin'] . '</td>' . '</tr>';
    }
    echo '</table>';
  }



  /////////////////////////////////////////////// Fonction pour supprimer les réservation faites par l'uitiliasteur connecté



  public function suppresa($_id) {

    $link = $this->_link;
    $SQL = $link->prepare("DELETE FROM reservations WHERE id_utilisateur = $_id");
    $SQL->execute();
    echo "<div class = 'creneaupris'><h2 class ='hdeux'>Annulation prise en compte</h2></div>";
  }



  //////////////////////////////////// Fonction pour Blocker les pages qui ne doivent pas etre vu 
  
  
  
  public function block() {

  if (isset($_SESSION['user'])) {
    $_SESSION['user'];
    header ("location:index.php");}
  }



  /////////////////////// update



  public function update ($_login, $_password) {
    $_login = ($_login);
    $_password = ($_password);

    $_ancienlog = $this->_login;
    $this->_login = $_login;
    $this->_password = $_password;
    
    $link = $this->_link;
    $req = "SELECT `login`, `password` FROM `utilisateurs`";
    $SQL = "UPDATE utilisateurs SET login='$_login', password='$_password' WHERE login ='$_ancienlog'";
    $query = $link->query($SQL);                                 
    echo "<p style= 'color: green'>les info ont bien été changé.</p>";
  }



  /////////////////////// getAllInfos

  public function getAllInfos () {
    $link = $this->_link;
    $SQL = "SELECT `titre`, `description`, `debut`, `fin` FROM reservations";
    $query = $link->query($SQL);
    $resultat = $query->fetch(PDO::FETCH_ASSOC);
    
    foreach($resultat as $key=>$value) {
      if($key==0){
          echo "<h5>Évenement: ".$value."</h5>";
      }
      elseif($key==1){
          echo "<h4>Description: ".$value."</h4>";
      }
      elseif($key==2){
          echo "<h4>Pour le: ".$value."</h4>";
      }
      elseif($key==3){
          echo "<h7>Au : ".$value."</h7>"."</br>";
          echo "<hr>";
      }
    }
  }
}