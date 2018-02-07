<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Commande</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
    <script src="script.js"></script>
</head>
<body>
<div id="commandeLivres" class="centreOmbre grandTableau">
    <h1>Liste de livres</h1>
    <h2>
        <?php
        session_start();
        if (isset($_SESSION["username"]) && $_SESSION["logged"] === true) {
            echo "Vous êtes connecté en tant que : " . $_SESSION["username"].", ID:".$_SESSION["idpersonne"]
                ."<a href='logout.php'>Click here to log out</a>";

        } else {
            $_SESSION["logged"] = false;
            die("Vous n'avez pas le droit de consulter cette page!"."<a href=\"../html/connexion.html\">-> Login</a>");
        }
        require('connectDB.php');
        $books = array();
        $i = 0;
        $res = $dbh->query("SELECT * FROM `ouvrages`");

        $res_all = $res->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res_all as $row) {
            $books[$i]['idouvrage'] = $row['idouvrage'];
            $books[$i]['titre'] = $row['titre'];
            $books[$i]['auteur'] = $row['auteur'];
            $books[$i]['prix'] = $row['prix'];
            $i++;
        }
        ?>
    </h2>
    <div class="otherLinks">
        <a href="../html/ajouterUnLivre.html">Ajouter un ouvrage</a><br>
        <a href="consultationListeCommandes.php">Consulter des commandes</a><br>
        <a href="consultationListeComptes.php">Consulter la liste de client</a><br>

    </div>
        <?php
        echo "<table>";
        echo "<tr><td><b>ID</b></td><td><b>Titre</b></td>><td><b>Auteur</b></td><td><b>Prix (€ HT)</b></td></tr>";
        foreach ($books as $value) {
            echo "<tr><td>" . $value['idouvrage'] . "</td><td>" .$value['titre']. "</td><td>" . $value['auteur'] . "</td><td>" . $value['prix']
                . "</td></tr>";
        }
        echo "</table>";
        ?>
</div>
</body>
</html>