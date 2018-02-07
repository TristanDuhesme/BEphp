<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Liste des comptes</title>
  <link rel="stylesheet" href="../css/stylesheet.css">
  <script src="script.js"></script>
</head>

<body>
<div id="listeCompte" class="centreOmbre grandTableau">
<h1>Liste des comptes clients</h1>
    <h2>
        <?php
        session_start();
        if (isset($_SESSION["username"]) && $_SESSION["logged"] === true) {
            echo "Bonjour " . $_SESSION["username"]."(ID:".$_SESSION["idpersonne"].")<br/><a href='logout.php'>Déconnexion</a>";

        } else {
            $_SESSION["logged"] = false;
            die("Vous n'avez pas le droit de consulter cette page! <br/><a href=\"../html/connexion.html\">Connexion</a>");
        }
        require('connectDB.php');
        $clients = array();
        $i = 0;
        $res = $dbh->query("SELECT * FROM `personnes` WHERE libraire = 0 ");

        $res_all = $res->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res_all as $row) {
            $clients[$i]['nom'] = $row['nom'];
            $clients[$i]['prenom'] = $row['prenom'];
            $clients[$i]['adresse'] = $row['adresse'];
            $i++;
        }
        ?>
    </h2>
    <div class="otherLinks">
        <a href="listeDeLivre.php">Liste des livres</a><br>
        <a href="../html/ajouterUnLivre.html">Ajouter un ouvrage</a><br>
        <a href="consultationListeCommandes.php">Consulter des commandes</a><br>
        <a href="consultationListeComptes.php">Consulter la liste de client</a><br/><br/>

    </div>




<?php
echo "<table>";
echo "<tr class = 'ligne'><td><b>Nom</b></td><td><b>Prénom</b></td><td><b>Adresse</b></td></tr>";
foreach ($clients as $value) {
    echo "<tr class = 'ligne'><td>" . $value['nom'] . "</td><td>" .$value['prenom']. "</td><td>" . $value['adresse']
        . "</td></tr>";
}
echo "</table>";
?>

</div>
</body>
</html>
