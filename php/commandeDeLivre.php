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
    <h1>Commander des livres</h1>
    <h2>
        <?php
        session_start();
        if (isset($_SESSION["username"]) && $_SESSION["logged"] === true) {
            echo "Vous êtes connecté en tant que : " . $_SESSION["username"];
        } else {
            $_SESSION["logged"] = false;
            die("Vous n'avez pas le droit de consulter cette page!");
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
    <form action="commande.php" method="post">

        <?php
        echo "<table>";
        echo "<tr><td><b>Titre</b><td><b>Auteur</b></td><td><b>Prix (€ HT)</b></td><td><b>Quantité</b></td></tr>";
        foreach ($books as $value) {
            echo "<tr><td>" . $value['titre'] . "</td><td>" . $value['auteur'] . "</td><td>" . $value['prix']
                . "<td class=\"quantiteLivre\"><input name=".$value['idouvrage']." type=\"number\" value=\"0\" min=\"0\"></input></td>"
                . "</td></tr>";
        }
        echo "</table>";

        ?>
        <button id="submit" type="submit">Passer commande</button>
    </form>
</div>
</body>
</html>