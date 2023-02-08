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
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Ajouter une randonnée</title>
    <meta content="width=device-width, initial-scale=1" name="viewport"/> <!--Responsive-->
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<div id="container">
    <header>
        <h1 id="p-title" class="text-center py-2">AJOUTER UNE RANDONNEE</h1>
    </header>

    <div id="div-message"></div>

    <div class="row">

        <div class="col-12 col-md-4"></div>

        <div class="col-12 col-md-4">

            <form action="read.php" method="post" id="form" class="d-inline">

				<label for ="name">Nom :</label><input type="text" id="name" name="name" value="" required><br>
                
				<label for="difficulty">Difficulté :</label>
				<select name="difficulty" id="difficulty" required>
                    <option value="">-- à préciser --</option>
					<option value="très facile">Très facile</option>
					<option value="facile">Facile</option>
					<option value="moyen">Moyen</option>
					<option value="difficile">Difficile</option>
					<option value="très difficile">Très difficile</option>
				</select><br>

                <label for="distance">Distance (km) :</label><input type="number" name="distance" value="" min="1" step="1" required><br>
				<label for="duration">Durée (hh:mm) :</label><input type="time" name="duration" value="" required><br>
				<label for="height_difference">Dénivelé (m) :</label><input type="number" name="height_difference" value="" min="1" step="1" required><br>

                <label for="available">Praticabilité :</label>
                <select name="available" id="available" required>
                    <option value="">-- à préciser --</option>
					<option value="Praticable">Praticable</option>
					<option value="Impraticable">Impraticable</option>
				</select><br><br>

                <input type ="hidden" name="formSubmit" value="1">
                <?php 
                    $chaine = "<button type =\"submit\">Enregistrer</button>";
                    echo ($profil == "user") ? "" : $chaine; 
                ?>  
                <!-- <button type="button" onclick="validerForm('form');">Créer</button>-->
            </form>
            <button id='bt-supprimer-non' onclick="window.location.href = 'read.php';" class="ml-5">Abandonner</button>
        </div>
        
        <div class="col-12 col-md-4"></div>
    </div>
<footer></footer>
</div>
<script
        src="https://code.jquery.com/jquery-3.6.3.slim.min.js"
        integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo="
        crossorigin="anonymous">
</script>
<!-- <script type="text/javascript" src="scriptcreate.js"></script>  -->
</body>
</html>
