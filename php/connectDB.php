<?php
$sql_server = 'localhost';
$sql_user = 'bdlibrairie';
$sql_pwd = 'bdlibrairie';
$sql_db = 'bdlibrairie';

try {
$dbh = new PDO('mysql:host='.$sql_server.';dbname='.$sql_db, $sql_user, $sql_pwd);

} catch (PDOException $e) {
print "Erreur !: " . $e->getMessage() . "<br/>";
die();
}
?>
