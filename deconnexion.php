<?php
session_start();

function deconnexion(){
    session_unset();
    session_destroy();
    //echo "Fin déconnexion";
    //echo '<SCRIPT>javascript:window.close()</SCRIPT>';
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
        <h1 id="p-title" class="text-center py-2">A bientôt</h1>
    </header>
    <div class="row">
    
        <div class="col-12 col-md-1"></div>

        <div class="col-12 col-md-11">
            
          <?php 
          deconnexion();
          ?>            

        </div>

        <div class="col-12 col-md-1"></div>
    </div>
    <footer></footer>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous">
</script>
<script type="text/javascript" src="deconnexion.js"></script>
</body>
</html>