<?php
    //checking if data has been entered
    if( isset( $_POST['nom'] ) && !empty( $_POST['nom'] )
	isset( $_POST['prenom'] ) && !empty( $_POST['prenom'] )
	isset( $_POST['addresse'] ) && !empty( $_POST['addresse'] )
	isset( $_POST['motdepasse'] ) && !empty( $_POST['motdepasse'] ))
    {
        $nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$addresse = $_POST['addresse'];
	$motdepasse = $_POST['motdepasse'];
    } else {
        header( 'location: form.html' );
        exit();
    }

    //setting up mysql details
    $sql_server = '172.17.3.37:3306';
    $sql_user = 'bdlibrairie';
    $sql_pwd = 'bdlibrairie';
    $sql_db = 'bdlibrairie';

    //connecting to sql database
    $myslqi = new mysqli( $sql_server, $sql_user, $sql_pwd, $sql_db ) or die( $mysqli->error );

    //inserting details into table
    $insert = $mysqli->query( "INSERT INTO table ( `personnes` ) VALUE ( '$nom $prenom $addresse $motdepasse' )" );

    //closing mysqli connection
    $mysqli->close;
?>
