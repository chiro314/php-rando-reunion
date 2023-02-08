<?php
function deconnexion(){
    
    session_unset();
    session_destroy();
    exit("<br>Menu : fin deconnexion()");
}

echo"<html><div class='menu mb-2'>
    <button id='bt-quitter'  onclick=\"deconnexion();\">Quitter</button>
    <button id='bt-menu-creer-rando'  onclick=\"window.location.href = 'create.php';\">Ajouter une randonnée</button>
</div></html>";


?>


