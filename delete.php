<?php
session_start();

$profil="user";
if(isset($_SESSION["username"])){
    $sessionUsername=$_SESSION["username"];
    $profil="admin";
}
else {
    $profil="user";
    session_unset();
    session_destroy();
}
echo "profil : ". $profil;

require "connexionbdd.php";

if (isset($_GET['id'])){
    $id = $_GET['id'];
    $sql=  "SELECT id, name from hiking where id = $id";
    $result= $conn->query($sql);        
    $row = $result-> fetch_assoc();
}
?>

<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <title>Supprimer une randonnée</title>
    <meta content="width=device-width, initial-scale=1" name="viewport"/> <!--Responsive-->
    <link rel="stylesheet" href="css/basics.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<div id="container">
    <header>
        <h1 id="p-title" class="text-center py-2">Suppression de la randonnée</h1>
    </header>
    <div class="row">

        <div class="col-12 col-md-4 ml-2"></div>

        <div class="col-12 col-md-4 pl-5">

            <p>Confirmez-vous la suppression de :</p>
            <?php if (isset($_GET['id'])) echo $row['id']." - ".$row['name']." ?<br><br>"; ?>
 
            <form action="read.php" method="post" id="form3" class="d-inline">

                <?php
                echo "<input type=\"hidden\" id=\"idSup\" name=\"idSup\"". (isset($_GET['id']) ? ("value=".$row['id']) : "") ." required><br><br>";
                ?>
                
                <input type ="hidden" name="formSubmit3" value="1">

                <?php 
                    $chaine = "<button type =\"submit\">OUI</button>";
                    echo ($profil == "user") ? "" : $chaine; 
                ?> 
            </form>
            <button id='bt-supprimer-non' onclick="window.location.href = 'read.php';" class="ml-5">NON</button>
        </div>
        
        <div class="col-12 col-md-4 pl-1"></div>
    </div>
<footer></footer>
</div>
<script
        src="https://code.jquery.com/jquery-3.6.3.slim.min.js"
        integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo="
        crossorigin="anonymous">
</script>
<!-- <script type="text/javascript" src="??????.js"></script>
-->
</body>
</html>