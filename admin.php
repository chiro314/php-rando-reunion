<?php
//http://localhost/exo/J10-TP-RANDO-SESSION/admin.php

require "connexionbdd.php";

if(isset($_SESSION["username"])){
    echo "$_SESSION : username : ".$sessionUsername=$_SESSION["username"];
    session_unset();
    session_destroy();
}

const USER = 0, PSW = 1;

if(isset($_POST["formSubmit0"]) and $_POST["formSubmit0"] == 1) {
    
    $strsTransmises = array($_POST['username'], $_POST['password']);
    $strsTestees = array(strip_tags($strsTransmises[USER]), strip_tags($strsTransmises[PSW]) );

    if(testerStrs("Le login")){

//ok : echo $_POST["username"]."  ".$_POST["password"];

        if (testerLogin($_POST["username"], $_POST["password"])){
            session_start();
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["profil"] = "admin";
            header("Location: http://localhost/exo/J10-TP-RANDO-SESSION/read.php");
        }
        else {
            if($nbLog > 1) echo "<br>Login/mot de passe en double.";
            else echo "<br>Login et/ou mot de passe inconnus";

            session_unset();
            //session_destroy();
        }
//echo "<br>".$login." (".$psw.") - ".$nbLog;
    }
}
$login = "";
$psw = "";
$nbLog = 0;
function testerLogin($username, $password){
    global $conn, $login, $psw, $nbLog;
    /*
    $stmt = $conn->prepare("SELECT username, password FROM user WHERE username = ? AND password = ?");
    $stmt ->bind_param("ss",$username, $password); 
    $stmt ->execute();

    while($row = $stmt->fetch_assoc()) {
        $login = $row['username']; 
        $psw = $row['password']; 
        $nbLog++;
    }
    $stmt -> close();
    */
    $passwordSha1 = sha1($password);
    $result = $conn->query("SELECT username, password FROM user WHERE username = '$username' AND password = '$passwordSha1'");

    while($row = $result->fetch_assoc()) {
        $login = $row['username']; 
        $psw = $row['password']; 
        $nbLog++;
    }
    if($nbLog == 1 and $passwordSha1 == $psw) return true;
    else return false;
}
function testerStrs($operation){
    global $strsTransmises;
    global $strsTestees;

    $adjOrdinal = ["1ère", "2e", "3e", "4e", "5e", "6e"];

    //Contrôles de chaque zone de saisie : 
    for($i=0;$i<count($strsTransmises);$i++) { 
        if ($strsTestees[$i] != $strsTransmises[$i]) {
            echo "PHP : "."L'information de la ".$adjOrdinal[$i]." zone n'était pas valide. ".$operation." n'a pas eu lieu.";
            return false;
        }
    }
    for($i=0;$i<count($strsTransmises);$i++) { 
        if(empty($strsTransmises[$i])) {
            echo "PHP : "."La ".$adjOrdinal[$i]." zone était vide. ".$operation." n'a pas eu lieu.";
            return false;
        }
    }
    //Tous les contrôles sont négatif (= sont OK) :
    return true;
}
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Randonnées - admin</title>
    <meta content="width=device-width, initial-scale=1" name="viewport"/> <!--Responsive-->
    <link rel="stylesheet" href="css/basics.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<div id="container">
    <header>
        <h1 id="p-title" class="text-center py-2">Randonnées - administration</h1>
    </header>
    <div class="row">
    
        <div class="col-12 col-md-4">
            <button class="ml-3" id='bt-menu-consulter-rando' onclick="window.location.href = 'read.php';">Consulter les randonnées</button>
        </div>

        <div class="col-12 col-md-4">
      
            <div id="div-alerte">
                <?php 
                ?>
            </div>
            <form action="admin.php" method="post" id="form0" class="d-inline">
                <br><br><br><br>
                <label for ="username">Nom utilisateur :</label><input type="text" id="username" name="username" value="" required><br>
                <label for ="password">Mot de passe :</label><input type="text" id="password" name="password" value="" required><br>

                <input type ="hidden" name="formSubmit0" value="1">

                <input type ="submit" value="Valider"> 
                
                <button id='bt-supprimer-non' type="reset" class="ml-5">Effacer tout</button>
                </form>
                <!--<button id='bt-supprimer-non' onclick="window.location.href = 'admin.php';" class="ml-5">Abandonner</button>-->
        </div>

        <div class="col-12 col-md-4"></div>
    </div>
    <footer></footer>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous">
</script>
<!-- <script type="text/javascript" src="deconnexion.js"></script> -->
</body>
</html>