<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Liste des commandes</title>
  <link rel="stylesheet" href="../css/stylesheet.css">
  <script src="script.js"></script>
</head>
<body>
<div id="listeCompte" class="centreOmbre grandTableau">
<h1>Liste des commandes</h1>
    <h2>
        <?php
        session_start();
        if (isset($_SESSION["username"]) && $_SESSION["logged"] === true) {
            echo "Bonjour " . $_SESSION["username"]."(ID:".$_SESSION["idpersonne"].")<br/><a href='logout.php'>Déconnexion</a>";

        } else {
            $_SESSION["logged"] = false;
            die(">Connexion</a>");
        }

        require('connectDB.php');
        $commandes = array();
        $i = 0;
        $res = $dbh->query("
                                        SELECT `commandes`.idcmd, `personnes`.nom, `personnes`.prenom, 
                                        sum(prix * qte) as montant, SUM(qte) as nb_livre FROM `commandes` 
                                        INNER JOIN `lignescmd` ON `commandes`.idcmd = `lignescmd`.`idcmd` 
                                        INNER JOIN `ouvrages` ON `ouvrages`.`idouvrage` = `lignescmd`.`idouvrage` 
                                        INNER JOIN `personnes` ON `commandes`.`idpersonne` = `personnes`.`idpersonne` 
                                        GROUP BY  `commandes`.idcmd ");

        $res_all = $res->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res_all as $row) {
            $commandes[$i]['idcmd'] = $row['idcmd'];
            $commandes[$i]['nom'] = $row['nom'];
            $commandes[$i]['prenom'] = $row['prenom'];
            $commandes[$i]['montant'] = $row['montant'];
            $commandes[$i]['nb_livre'] = $row['nb_livre'];
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
    <div>
        <?php
        echo "<table>";
        echo "<tr><td><b>Commande ID</b></td><td><b>Nom</b></td><td><b>Prenom</b></td><td><b>Montant (€)</b></td><td><b>Nombre de livre</b></td><td><b>Détail</b></td></tr>";
        foreach ($commandes as $value) {
            echo "<form action=\"consultationDetailCommandes.php\" method='post'>";
            echo "<tr><td>" . $value['idcmd'] . "</td><td>" .$value['nom']. "</td><td>" . $value['prenom'] . "</td><td>" . $value['montant']. "</td><td>" .$value['nb_livre']
                . "<input name=\"idcmd\" value =".$value['idcmd'] ." type=\"hidden\" >"
                ."</td><td><button id=\"submit2\"".$value['idcmd']."type=\"submit\">Voir le détail</button>"
                . "</td></tr>";
            echo "</form>";

        }
        echo "</table>";
        ?>
    </div>

</div>
</body>
</html>
