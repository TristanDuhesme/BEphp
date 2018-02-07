<?php
require('connectDB.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

//checking if data has been entered
if( isset( $_POST['titre'] ) && !empty( $_POST['titre'] ) &&
    isset( $_POST['auteur'] ) && !empty( $_POST['auteur'] ) &&
    isset( $_POST['prix'] ) && !empty( $_POST['prix'] ))
{
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $prix = $_POST['prix'];

} else {
    exit();
}

$insert = $dbh->query( "INSERT INTO `ouvrages` (`idouvrage`,`titre`,`auteur`,`prix` ) VALUES ( '','$titre', '$auteur', '$prix')" );

if ($insert){
    header("Location: listeDeLivre.php");
} else{
    header("Location: ../html/ajouterUnLivre.html");
}

$insert = null;
$dbh = null;

?>
