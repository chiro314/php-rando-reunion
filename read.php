<?php
//http://localhost/exo/J10-TP-RANDO-SESSION_access_admin_et_user/read.php
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

const NOM = 0, DIF = 1, DIST = 2, DUREE = 3, DENIV =4, PRATIC =5;

function droit($monProfil, $operation){
    if ($monProfil == "admin") return true;
    else {
        echo "Votre profil n'est pas habilité à ".$operation.".";
        return false;
    }
}

function updateRando($id, $name, $difficulty, $distance, $duration, $height_difference, $available){
    global $conn;
    $stmt = $conn->prepare("UPDATE hiking set name = ?, difficulty = ?, distance = ?, duration = ?, height_difference = ?, available = ? WHERE id = ?");
    $stmt -> bind_param("ssisisi",$name, $difficulty, $distance, $duration, $height_difference, $available, $id); 
    $stmt ->execute();
    $stmt -> close();
}
if(isset($_POST["formSubmit2"]) and $_POST["formSubmit2"] == 1 and droit($profil, "modifier")) {

//echo "<br>2-avant testerStrs() : ".$_POST["id"]."!".$_POST["name"]. $_POST["difficulty"]. $_POST["distance"]. $_POST["duration"]. $_POST["height_difference"];

    $strsTransmises = array($_POST['name'], $_POST['difficulty'], $_POST['distance'], $_POST['duration'], $_POST['height_difference'], $_POST['available']);
    $strsTestees = array(strip_tags($strsTransmises[NOM]), strip_tags($strsTransmises[DIF]), strip_tags($strsTransmises[DIST]), strip_tags($strsTransmises[DUREE]), strip_tags($strsTransmises[DENIV]), strip_tags($strsTransmises[PRATIC]) );

    if(testerStrs("La modification")){
//echo "<br>2 bis-après testerStrs() et avant updateRando() : ".$_POST["id"]."!".$_POST["name"]. $_POST["difficulty"]. $_POST["distance"]. $_POST["duration"]. $_POST["height_difference"];
        updateRando($_POST["id"], $_POST["name"], $_POST["difficulty"], $_POST["distance"], $_POST["duration"], $_POST["height_difference"], $_POST["available"] );
        echo "La modification a été réalisée.";
    }
}

function supRando($id){
    global $conn;
    $stmt = $conn->prepare("DELETE FROM hiking WHERE ID = ?");
    $stmt -> bind_param("i",$id); 
    $stmt ->execute();
    $stmt -> close();
}
if(isset($_POST["formSubmit3"]) and $_POST["formSubmit3"] == 1 and droit($profil, "supprimer")){
    supRando($_POST["idSup"]);
}

function insertRando($name, $difficulty, $distance, $duration, $height_difference, $available){
    global $conn;
    $stmt = $conn->prepare("INSERT INTO hiking (name, difficulty, distance, duration, height_difference, available) VALUES (?,?,?,?,?,?)");
    $stmt -> bind_param("ssisis",$name, $difficulty, $distance, $duration, $height_difference, $available); 
    $stmt ->execute();
    $stmt -> close();
}
if(isset($_POST["formSubmit"]) and $_POST["formSubmit"] == 1 and droit($profil, "ajouter")) {
    
    $strsTransmises = array($_POST['name'], $_POST['difficulty'], $_POST['distance'], $_POST['duration'], $_POST['height_difference'], $_POST['available'] );
    $strsTestees = array(strip_tags($strsTransmises[NOM]), strip_tags($strsTransmises[DIF]), strval(intval(strip_tags($strsTransmises[DIST]))), strip_tags($strsTransmises[DUREE]), strval(intval(strip_tags($strsTransmises[DENIV]))), strip_tags($strsTransmises[PRATIC])  );

    if(testerStrs("L'ajout")){
        insertRando($_POST["name"], $_POST["difficulty"], $_POST["distance"], $_POST["duration"], $_POST["height_difference"], $_POST["available"]);
        echo "L'ajout a été réalisé.";
    }
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
    if($strsTestees[DIST] <=0){
        echo "PHP : "."La distance doit être un nombre entier strictement supérieur à 0. ".$operation." n'a pas eu lieu.";
        return false;
    }
    if($strsTestees[DIST] <=0){
        echo "PHP : "."Le dénivelé doit être un nombre entier strictement supérieur à 0. ".$operation." n'a pas eu lieu.";
        return false;
    }
    //Tous les contrôles sont négatif (= sont OK) :
    return true;
}

?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Randonnées</title>
    <meta content="width=device-width, initial-scale=1" name="viewport"/> <!--Responsive-->
    <link rel="stylesheet" href="css/basics.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<div id="container">
    <header>
        <h1 id="p-title" class="text-center py-2">Liste des randonnées</h1>
    </header>
    <div class="row">
    
        <div class="col-12 col-md-1"></div>

        <div class="col-12 col-md-11">
            
          <?php //require "menurando.php";?>
          <button id='bt-quitter'          onclick="window.location.href = 'deconnexion.php';">Quitter</button>
          <button id='bt-menu-creer-rando' onclick="window.location.href = 'create.php';">Ajouter une randonnée</button>

          <?php
          $sql = "SELECT id, name, difficulty, distance, duration, height_difference, available FROM hiking";
          $result = $conn->query($sql); echo "<br>"; ?>
          <table>
            <tr>
                <?php echo ($profil == "admin") ? "<th></th>" : ""; ?>
                
                <th>Nom</th><th>Difficulté </th><th>Distance (km) </th><th>Durée (h) </th><th>Dénivelé (m)</th><th>Praticabilité</th>
            </tr>

            <?php while($row = $result-> fetch_assoc()) {
                
            ?>
              <tr>
                <?php
                $chaine = "<td><a href=\"delete.php?id=".$row['id']."\">Supprimer </a></td>";
                echo ($profil == "admin") ? $chaine : "";
                ?>

                <td><a href="<?php echo 'update.php?id='.$row['id']?>"><?php echo $row['name'] ?> </a></td>
                
                <td><?php echo "(".$row['difficulty'].")" ?></td>
                <td><?php echo $row['distance'] ?></td><td><?php echo $row['duration'] ?></td><td><?php echo $row['height_difference'] ?></td><td><?php echo $row['available'] ?></td>
              </tr>
            <?php
            }
            ?>            
          </table>
        </div>

        <div class="col-12 col-md-1"></div>
    </div>
    <footer></footer>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous">
</script>
<!-- <script type="text/javascript" src="deconnexion.js"></script>  -->
</body>
</html>