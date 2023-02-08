<?php
//http://localhost/exo/J10-TP-RANDO-SESSION/dbdraft.php
require "connexionbdd.php";


function insertUser($username, $email, $firstname, $lastname, $password){
    global $conn;
    $stmt = $conn->prepare("INSERT INTO user (username, email, firstname, lastname, password) VALUES (?,?,?,?,?)");
    $stmt -> bind_param("sssss",$username, $email, $firstname, $lastname, $password); 
    $stmt ->execute();
    $stmt -> close();
}
insertUser("chiro", "christian.mareau@gmail.com","Christian", "Mareau","psw");

/*
function insertRando($name, $difficulty, $distance, $duration, $height_difference){
    global $conn;
    $stmt = $conn->prepare("INSERT INTO hiking (name, difficulty, distance, duration, height_difference) VALUES (?,?,?,?,?)");
    $stmt -> bind_param("ssisi",$name, $difficulty, $distance, $duration, $height_difference); 
    $stmt ->execute();
    $stmt -> close();
}
/*
insertRando("Le Dimitile", "difficile", 24.5, "10:00:00", 1550);
insertRando("Le sentier des sources", "facile", 4.8, "01:15:00", 280);
insertRando("Deux boucles", "moyen", 12.2, "05:00:00", 850);
insertRando("La Mare à Joncs", "difficile", 16.5, "07:00:00", 1420);
insertRando("Le sommet du Piton Béthoune", "très difficile", 5.7, "04:00:00", 650);
*/
/*
$sql = "SELECT name, difficulty, distance, duration, height_difference FROM hiking";  $result = $conn->query($sql); echo "<br>";
while($row = $result-> fetch_assoc()) {echo $row['name']." (".$row['difficulty'].") - ".$row['distance']." km - ".$row['duration']." h - ".$row['height_difference']." m de dénivelé<br>";}
*/
/*
- Creer un script php qui permet d'afficher les éléves et les informations de l'éléve dans une seule et même requete sql
- Lister les compétences de l'éléve et son niveau dans cette compétence ainsi que son niveau auto évalué.
- Vous afficherez le niveau d'une compétence sous la forme d'un diagramme polaire.
- Vous ajouterez un second diagramme polaire par dessus le premier pour afficher le niveau auto évalué dans une compétence

//RE%PLISSAGE DE LA BASE :

function insertEleve($prenom, $nom, $login, $psw){
    global $conn;
    $sql = "INSERT INTO eleves VALUES ('', '$prenom', '$nom', '$login', '$psw')" ;
    $conn->query($sql);
}

insertEleve("Paul", "Renard", "log1", "psw1");
insertEleve("Marie", "Renarde", "log2", "psw2");
insertEleve("Julie", "Dupont", "log3", "psw3");
insertEleve("Dominic", "Martin", "log4", "psw4");
insertEleve("Etienne", "Renault", "log5", "psw5");
insertEleve("Jean-Marc", "Mareau", "log6", "psw6");

insertEleve("Julien", "Marceau", "log7", "psw7");


$sql = "SELECT NOM FROM eleves";  $result = $conn->query($sql); echo "<br>";
while($row = $result-> fetch_assoc()) {echo "  NOM : ".$row['NOM']."<br>";}


function insertCompetence($titre, $description){
    global $conn;
    $sql = "INSERT INTO competences VALUES ('', '$titre', '$description')" ;
    $conn->query($sql);
}

function insertCompetence($titre, $description){
    global $conn;
    $stmt = $conn->prepare("INSERT INTO competences (TITRE, DESCRIPTION) VALUES (?,?)");
    $stmt -> bind_param("ss",$titre, $description); 
    $stmt ->execute();
    $stmt -> close();
}

$sql = "INSERT INTO competences VALUES ('', 'Imagination', 'Faculté de faire des combinaisons nouvelles d\'images ou d\'idées.')";   
$conn->query($sql);

//insertCompetence("Imagination", "Faculté de faire des combinaisons nouvelles d'images ou d'idées.");
//insertCompetence("Curiosité", "Tendance qui porte à apprendre, à connaître des choses nouvelles ou cachées.");
//insertCompetence("Autonomie", "Faculté d\'agir librement, indépendance.");
//insertCompetence("Humour", "Forme d\'esprit qui consiste à dégager les aspects plaisants et insolites de la réalité.");
//insertCompetence("Persévérance", "Action de persévérer, qualité, conduite de quelqu\'un qui persévère.");


$sql = "SELECT TITRE FROM competences";  $result = $conn->query($sql); echo "<br>";
while($row = $result-> fetch_assoc()) {echo "  TITRE : ".$row['TITRE']."<br>";}


//AGE VILLE AVATAR ELEVES_ID
// OK :
$sql = "INSERT INTO eleves_informations VALUES ('15', 'Paris', 'paulrenard1.png','1')";   $conn->query($sql);
$sql = "INSERT INTO eleves_informations VALUES ('18', 'Paris', 'marierenarde2.png','2')";   $conn->query($sql);
$sql = "INSERT INTO eleves_informations VALUES ('14', 'Lille', 'juliedupont3.png','3')";   $conn->query($sql);
$sql = "INSERT INTO eleves_informations VALUES ('16', 'Bordeaux', 'dominicmartin4.png','4')";   $conn->query($sql);
$sql = "INSERT INTO eleves_informations VALUES ('18', 'Lille', 'etiennerenault5.png','5')";   $conn->query($sql);
$sql = "INSERT INTO eleves_informations VALUES ('15', 'Nemours', 'jeanmarcmareau6.png','6')";   $conn->query($sql);
$sql = "INSERT INTO eleves_informations VALUES ('15', 'Paris', 'julienmarceau7.png','7')";   $conn->query($sql);

//ID NINEAU NIVEAU_AE ELEVES_ID (1-7) COMPETENCES_ID (1-5)
function insertEleveCompetence($niveau, $niveau_ae, $eleve_id, $competence_id){
    global $conn;
    $sql = "INSERT INTO eleves_competences VALUES ('', '$niveau', '$niveau_ae', '$eleve_id', '$competence_id')" ;
    $conn->query($sql);
}

insertEleveCompetence('10', '12', '1', '1');
insertEleveCompetence('8', '7', '1', '2');
insertEleveCompetence('12', '12', '1', '3');
insertEleveCompetence('14', '15', '1', '4');
insertEleveCompetence('9', '8', '1', '5');

insertEleveCompetence('11', '11', '2', '1');
insertEleveCompetence('5', '7', '2', '2');
insertEleveCompetence('14', '18', '2', '3');
insertEleveCompetence('12', '10', '2', '4');

insertEleveCompetence('8', '12', '3', '1');
insertEleveCompetence('8', '12', '3', '2');
insertEleveCompetence('12', '8', '3', '3');

insertEleveCompetence('10', '12', '4', '1');
insertEleveCompetence('18', '17', '4', '2');

insertEleveCompetence('17', '12', '5', '1');
insertEleveCompetence('3', '9', '5', '2');
insertEleveCompetence('9', '3', '5', '3');
insertEleveCompetence('14', '16', '5', '4');
insertEleveCompetence('19', '18', '5', '5');

insertEleveCompetence('10', '12', '6', '1');
insertEleveCompetence('8', '7', '6', '2');
insertEleveCompetence('12', '12', '6', '3');
insertEleveCompetence('14', '15', '6', '4');
insertEleveCompetence('9', '8', '6', '5');


//afficher les éléves et les informations de l'éléve dans une seule et même requete sql :

$sql="SELECT E.PRENOM, E.NOM, E.LOGIN, E.PSW, EI.AGE, EI.VILLE, EI.AVATAR FROM eleves AS E LEFT OUTER JOIN eleves_informations AS EI ON E.ID = EI.ELEVES_ID";
$result = $conn->query($sql);
echo "<br>";
//echo "  PRENOM : ".$row['PRENOM']." - NOM : ".$row['NOM']." - LOGIN : ".$row['LOGIN']." - PSW : ".$row['PSW']." - AGE : ".$row['AGE']." ans - VILLE : ".$row['VILLE']." - AVATAR : ".$row['AVATAR']."<br>";
while($row = $result-> fetch_assoc()) { ?>
    <html><img src="<?php $row['AVATAR'] ?>" alt=" <?php $row['AVATAR'] ?>"> </html>
    <?php
    echo " ".$row['AVATAR']."  PRENOM : ".$row['PRENOM']." - NOM : ".$row['NOM']." - LOGIN : ".$row['LOGIN']." - PSW : ".$row['PSW']." - AGE : ".$row['AGE']." ans - VILLE : ".$row['VILLE']."<br>";

}


//ID eleve >> eleves (ID) / NOM PRENOM AGE AVATAR

$sql="SELECT E.PRENOM, E.NOM, EI.AGE, EI.AVATAR FROM eleves AS E LEFT OUTER JOIN eleves_informations AS EI ON E.ID = EI.ELEVES_ID WHERE E.ID=1";
$result = $conn->query($sql);
$row = $result-> fetch_assoc();

echo "<br>"; ?>
<html><img src="<?php echo $row['AVATAR'] ?>" alt=" <?php echo $row['AVATAR'] ?>"> </html>
<?php
echo " ".$row['NOM']." ".$row['PRENOM']." - ".$row['AGE']." ans<br><br>";

//ID eleve >> eleves_competences (ELEVES_ID) AS EC / NIVEAU NIVEAU_AE 
//competences (EC.COMPETENCE_ID) : TITRE DESCRIPTION

$sql = "SELECT EC.NIVEAU, EC.NIVEAU_AE, C.TITRE FROM eleves_competences AS EC LEFT OUTER JOIN competences AS C ON C.ID = EC.COMPETENCES_ID WHERE EC.ELEVES_ID = 1";
$result = $conn->query($sql);
echo "<br><br><br>";
while($row = $result-> fetch_assoc()) {
    echo " ".$row['TITRE']." - Niveau réel : ".$row['NIVEAU']." / Niveau perçu : ".$row['NIVEAU_AE']."<br><br>";
}


///////////////////////////////// FIN ELEVES //////////////////////////////////////////////////////////////////////////////

function insertUser($prenom, $nom, $mail){
    global $conn;
    $sql = "INSERT INTO users VALUES ('', '$prenom', '$nom', '$mail')" ;
    $conn->query($sql);
}

insertUser("Paul", "Renard", "m1@gmail.com");
insertUser("Paulette", "Renarde", "m2@gmail.com");
insertUser("Jean", "Moulin", "m3@gmail.com");

//ID USERID COMMENT COMMENTDATE
function insertComment($userid, $commment, $commmentdate){
    global $conn;
    $sql = "INSERT INTO comments VALUES ('', '$userid', '$commment', '$commmentdate')" ;
    $conn->query($sql);
}

insertComment('1', 'hello world', '');
insertComment('', 'Coucou tout le monde', '');
insertComment('2', 'Mes commentaires sont là', '');
insertComment('3', 'Hy everybody', '');
insertComment('4', 'Blablabla', '');

//INNER JOIN : tous les commentaires qui ont un user
$sql="SELECT users.PRENOM, comments.COMMENT FROM users INNER JOIN comments ON users.ID = comments.USERID";
$result = $conn->query($sql);
while($row = $result-> fetch_assoc()) {
    echo "  PRENOM : ".$row['PRENOM']."  COMMENT : ".$row['COMMENT']."<br>";
}

insertUser("Michel", "Dupont", "m4@gmail.com");
insertUser("Marie", "Dufour", "m5@gmail.com");

// LEFT JOIN : tous les users avec ou sans commentaire commentaire
$sql="SELECT users.PRENOM, users.NOM, comments.COMMENT FROM users LEFT OUTER JOIN comments ON users.ID = comments.USERID";
$result = $conn->query($sql);
echo "<br>";
while($row = $result-> fetch_assoc()) {
    echo "  PRENOM : ".$row['PRENOM']." - NOM : ".$row['NOM']." - COMMENT : ".$row['COMMENT']."<br>";
}

// LEFT JOIN WHERE : les users qui n'ont pas fait de commentaire
$sql="SELECT users.PRENOM, users.NOM, comments.COMMENT FROM users LEFT OUTER JOIN comments ON users.ID = comments.USERID WHERE comments.USERID IS NULL";
$result = $conn->query($sql);
echo "<br>";
while($row = $result-> fetch_assoc()) {
    echo "  PRENOM : ".$row['PRENOM']." - NOM : ".$row['NOM']."<br>";
}

insertComment('', 'salut monde', '');

// RIGHT JOIN WHERE : tous les commentaires y compris c'eux qui n'ont pas de user 
$sql="SELECT users.PRENOM, users.NOM, comments.COMMENT FROM users RIGHT OUTER JOIN comments ON users.ID = comments.USERID";
$result = $conn->query($sql);
echo "<br>";
while($row = $result-> fetch_assoc()) {
    echo "  PRENOM : ".$row['PRENOM']." - NOM : ".$row['NOM']." - COMMENT : ".$row['COMMENT']."<br>";
}
*/