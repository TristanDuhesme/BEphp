<?php

require('connectDB.php');
session_start();
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
    $rows = $passworkcheck->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();
}

if ($rows){
    session_start();
    foreach ($rows as $row){
        $_SESSION["username"] = $nom;
        $_SESSION["idpersonne"] = $row['idpersonne'];
        $_SESSION["logged"] = true;
    }
    //header("location: test.php");
    if($_POST['logType'] != 'client')
        header("Location: listeDeLivre.php");
    else
        header("Location: commandeDeLivre.php");
} else{
    header("Location: ../html/index.html");
    $_SESSION["logged"] = false;
}


$passworkcheck = null;
$dbh = null;
?>
