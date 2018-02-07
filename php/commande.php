<?php
require('connectDB.php');
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

//checking if data has been entered
if( isset( $_POST['idouvrage']) && isset($_POST['quantiteLivre']) && $_SESSION["logged"] === true)
{
    $post_count = count($_POST['idouvrage']);
    $idouvrage_list = array();
    $quantiteLivre_list = array();
    $idouvrage_list = $_POST['idouvrage'];
    $quantiteLivre_list = $_POST['quantiteLivre'];
    $idpersonne = $_SESSION["idpersonne"];

} else {
    exit();
}

$insert_cmd = $dbh->query( "INSERT INTO `commandes` (`idcmd`,`idpersonne`,`date`,`validee` ) VALUES ( '', '$idpersonne', 'GETDATE()','0')" );
$commandid  = $dbh->lastInsertId();

$insert = $dbh->prepare( "INSERT INTO `lignescmd` (`idcmd`,`idouvrage`,`qte` ) VALUES ( '$commandid', ?, ?)" );
//closing mysqli connection
$insert->bindParam(1, $idouvrage);
$insert->bindParam(2, $quantiteLivre);

for ($i = 0; $i < $post_count; $i++) {
    if ($quantiteLivre_list[$i] > 0) {
        $idouvrage = $idouvrage_list[$i];
        $quantiteLivre = $quantiteLivre_list[$i];
        $insert->execute();
    }
}



$insert_cmd = null;
$insert = null;
$dbh = null;
?>
