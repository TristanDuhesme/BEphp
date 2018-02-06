<?php

require('connectDB.php');

//checking if data has been entered
if( isset( $_POST['logType'] ) && !empty( $_POST['logType'] ) &&
    isset( $_POST['nom'] ) && !empty( $_POST['nom'] ) &&
    isset( $_POST['motdepasse'] ) && !empty( $_POST['motdepasse'] ))
{
    if($_POST['logType'] == 'client') {
        $logType = 0;
    }else{
        $logType = 1;
    }
    $nom = $_POST['nom'];
    $motdepasse = $_POST['motdepasse'];

} else {
    exit();
}

try {
    $passworkcheck = $dbh->query( "SELECT * FROM `personnes` WHERE nom = '".$nom."' AND password ='".$motdepasse."' AND libraire = ".$logType );
    $rows = $passworkcheck->fetchAll(PDO::FETCH_COLUMN, 1);
} catch (PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();
}

if ($rows){
    header("Location: ../html/commandeDeLivre.html");
} else{
    header("Location: ../html/connexion.html");
}

$insert = null;
$dbh = null;
?>