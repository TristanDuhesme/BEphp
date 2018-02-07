<?php
require('connectDB.php');
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

    //checking if data has been entered
    if( isset( $_POST['nom'] ) && !empty( $_POST['nom'] ) &&
	isset( $_POST['prenom'] ) && !empty( $_POST['prenom'] ) &&
	isset( $_POST['addresse'] ) && !empty( $_POST['addresse'] ) &&
	isset( $_POST['motdepasse'] ) && !empty( $_POST['motdepasse'] ))
    {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
	    $addresse = $_POST['addresse'];
	    $motdepasse = $_POST['motdepasse'];
	
    } else {
        exit();
    }

    $insert = $dbh->query( "INSERT INTO `personnes` (`idpersonne`,`nom`,`prenom`,`adresse`,`password`,`libraire` ) VALUES ( '','$nom', '$prenom', '$addresse', '$motdepasse','0' )" );
    $idpersonne  = $dbh->lastInsertId();
    //closing mysqli connection




	

if($insert){
header("Location: commandeDeLivre.php");
$_SESSION["signupOK"] = true;
$_SESSION["logged"] = true;
$_SESSION["username"] = $nom;
$_SESSION["idpersonne"] = $idpersonne;
}

$insert = null;    
	$dbh = null;
?>
