<?php
require('connectDB.php');
$books = array();
$i = 0;
$res = $dbh->query( "SELECT * FROM `ouvrages`");

$res_all = $res->fetchAll(PDO::FETCH_ASSOC);
foreach ($res_all as $row){
    $books[$i]['idouvrage'] = $row['idouvrage'];
    $books[$i]['titre'] = $row['titre'];
    $books[$i]['auteur'] = $row['auteur'];
    $books[$i]['prix'] = $row['prix'];
    $i++;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>
<body>

<?php
echo "<table>";
foreach ($books as $value) {
    echo "<tr><td>" . $value['titre'] . "</td><td>" . $value['auteur'] . "</td><td>" . $value['prix']
        . "<td class=\"quantiteLivre\"><input name=\"cyrano\" type=\"number\" value=\"0\" min=\"0\"></input></td>"
        . "</td></tr>";
}
echo "</table>";

?>
<a href="">Passer commande</a>
</body>
</html>
