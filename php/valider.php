<?php

require('connectDB.php');
session_start();
//checking if data has been entered
if (isset($_POST['idcmd']) && !empty($_POST['idcmd'])) {
    $idcmd = $_POST['idcmd'];

} else {
    exit();
}

try {
    $valider = $dbh->query( "UPDATE `commandes` SET validee = 1 WHERE idcmd = ".$idcmd);


} catch (PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();
}

header("Location: consultationDetailCommandes.php");
$_SESSION['idcmd'] = $idcmd;
$insert = null;
$dbh = null;

?>