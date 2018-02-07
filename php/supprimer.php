<?php

require('connectDB.php');

//checking if data has been entered
if (isset($_POST['idcmd']) && !empty($_POST['idcmd'])) {
    $idcmd = $_POST['idcmd'];

} else {
    exit();
}


try {
    $delete_lignescmd = $dbh->query( "DELETE FROM `lignescmd` WHERE idcmd = ".$idcmd);
    $delete_commandes = $dbh->query( "DELETE FROM `commandes` WHERE idcmd = ".$idcmd);


} catch (PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();
}

header("Location: consultationListeCommandes.php");
$insert = null;
$dbh = null;

?>