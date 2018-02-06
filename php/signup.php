<?php
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

    //setting up mysql details
    $sql_server = 'localhost';
    $sql_user = 'bdlibrairie';
    $sql_pwd = 'bdlibrairie';
    $sql_db = 'bdlibrairie';

    try {
    	$dbh = new PDO('mysql:host='.$sql_server.';dbname='.$sql_db, $sql_user, $sql_pwd);
    	/*foreach($dbh->query('SELECT * from FOO') as $row) {
    	    print_r($row);
    	}
    	$dbh = null;*/
    } catch (PDOException $e) {
    	print "Erreur !: " . $e->getMessage() . "<br/>";
    	die();
    }

    //connecting to sql database
  //  $myslqi = new mysqli( $sql_server, $sql_user, $sql_pwd, $sql_db ) or die( $mysqli->error );

    //inserting details into table
    $insert = $dbh->query( "INSERT INTO `personnes` (`idpersonne`,`nom`,`prenom`,`adresse`,`password`,`libraire` ) VALUES ( '','$nom', '$prenom', '$addresse', '$motdepasse','0' )" );

    //closing mysqli connection
	$insert = null;    
	$dbh = null;
?>
